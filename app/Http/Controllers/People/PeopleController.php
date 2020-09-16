<?php

namespace App\Http\Controllers\People;

use App\Http\Controllers\Controller;
use App\Models\People\{People,Document,Contact,AcademicInformation,History};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;


class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $peoples = People::all()->where('enabled', '1');
        return $this->showAll($peoples);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->input('people'), [
            'names' => 'required',
            'surnames' => 'required',
            'type_document_id' => 'required',
            'document_number' => 'required|unique:people',
            'birth_date' => 'required',
            'birth_town_id' => 'required',
            'gender_id' => 'required',
            'address_residence' => 'required',
            'neighborhood_id' => 'required',
            'occupation_id' => 'required|numeric',
            'type_people_id' => 'required|numeric'

        ]);
        $cammbioNombres = array(
            'name' => 'Nombre del barrrio',
        );
        $validator->setAttributeNames($cammbioNombres);
        if ($validator->fails()) {
            return ($this->errorResponse($validator->errors(), 422));
        }
        try {
            DB::beginTransaction();
            $people = new People();
            $people = $people->create($request->input('people'));
            /**
             * Registra el cargo de la persona
             */
            $this->registerHistoryPosition(['people_id'=>$people->id,'history_type_id'=> 2, 'start_date'=> $people->date_role_change,'type_people_id'=>$people->type_people_id]);
            /**
             * Valida la imagen
             */
            if ($request->input('imagen')) {
                $imagenData = $request->input('imagen');
                $data64 = $imagenData['imagen'];
                $extension = explode('/', explode(':', substr($data64, 0, strpos($data64, ';')))[1])[1];   // .jpg .png .pdf
                $replace = substr($data64, 0, strpos($data64, ',') + 1);
                $archive = str_replace($replace, '', $data64);
                $archive = str_replace(' ', '+', $archive);
                $longitud = strlen($extension);
                if ($longitud > 6) {
                    $calculaExtension = explode(".", $imagenData['name']);
                    $extension = $calculaExtension[1];
                }
                $nameFIle = $people->id . round(microtime(true) * 1000) . '.' . $extension;
                Storage::disk('public')->put('people/images/' . $nameFIle, base64_decode($archive));
                $people->imagen = $nameFIle;
                $people->update();
            }
            foreach ($request->input('contacts') as $contact) {
                $contact['contact_type_id'] = $contact['contact_type_id']['id'];
                $people->contacts()->create($contact);
            }
            foreach ($request->input('documents') as $document) {
                $document['category_document_id'] = $document['category_document_id']['id'];
                $people->documents()->create($document);
            }

            foreach ($request->input('academicInformations') as $academicInformation) {
                $academicInformation['training_type_id'] = $academicInformation['training_type_id']['id'];
                $people->academicInformations()->create($academicInformation);
            }
            if(!empty($request->input('historys')) ){
                foreach ($request->input('historys') as $history) {
                    $people->historys()->create($history);
                }
            }
            DB::commit();
            return ($this->showWithRelatedModels($people, 200));
        } catch (Exception $e) {
            DB::rollback();
            return ($this->errorResponse($e->getMessage(), 422));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\People\People  $people
     * @return \Illuminate\Http\Response
     */
    public function show(People $people)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\People\People  $people
     * @return \Illuminate\Http\Response
     */
    public function edit(People $people)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\People\People  $people
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $people = People::find($id);
            if($people->type_people_id !=$request->input('people.type_people_id')){
            /**
             * Registra el cargo de la persona
             */
            $this->registerHistoryPosition(['people_id'=>$people->id,'history_type_id'=> 2, 'start_date'=> $request->input('people.date_role_change'),'type_people_id'=> $request->input('people.type_people_id')]);
            }
            if(!$request->input('imagen') && $people->imagen){
                $image_path = storage_path('app/public/') . 'people/images/' . $people->imagen;
                if(file_exists($image_path)) {
                    unlink($image_path);
                }
                $request->input('people')['imagen'] = '';
            }
            $people->update($request->input('people'));
            if ($request->input('imagen')  && $request->input('imagen') != 'N/A') {
                $imagenData = $request->input('imagen');
                $data64 = $imagenData['imagen'];
                $extension = explode('/', explode(':', substr($data64, 0, strpos($data64, ';')))[1])[1];   // .jpg .png .pdf
                $replace = substr($data64, 0, strpos($data64, ',') + 1);
                $archive = str_replace($replace, '', $data64);
                $archive = str_replace(' ', '+', $archive);
                $longitud = strlen($extension);
                if ($longitud > 6) {
                    $calculaExtension = explode(".", $imagenData['name']);
                    $extension = $calculaExtension[1];
                }
                $nameFIle = $people->id . round(microtime(true) * 1000) . '.' . $extension;
                Storage::disk('public')->put('people/images/' . $nameFIle, base64_decode($archive));
                $people->imagen = $nameFIle;
                $people->update();
            }
            foreach ($request->input('contacts') as $contact) {
                $contact['contact_type_id'] = $contact['contact_type_id']['id'];
                $state = $contact['state'];
                $contact = Arr::except($contact, ['state']);
                //array_forget($contact, 'state');
                if($contact['id'] && $contact['id'] != 'null'){
                    $Contact = Contact::find($contact['id']);
                    if($state){
                        $Contact->update($contact);
                    }else{
                        $Contact->destroy($contact);
                    }
                }else{
                    $people->contacts()->create($contact);
                }
            }
            foreach ($request->input('documents') as $document) {
                $document['category_document_id'] = $document['category_document_id']['id'];
                $state = $document['state'];
                $document = Arr::except($document, ['state']);
                if($document['id'] && $document['id'] != 'null'){
                    $Document = Document::find($document['id']);
                    if($state){
                        $Document->update($document);
                    }else{
                        $Document->destroy($document);
                    }
                }else{
                    $people->documents()->create($document);
                }
            }

            foreach ($request->input('academicInformations') as $academicInformation) {
                $academicInformation['training_type_id'] = $academicInformation['training_type_id']['id'];
                $state = $academicInformation['state'];
                $academicInformation = Arr::except($academicInformation, ['state']);
                if($academicInformation['id'] && $academicInformation['id'] != 'null'){
                    $AcademicInformation = AcademicInformation::find($academicInformation['id']);
                    if($state){
                        $AcademicInformation->update($academicInformation);
                    }else{
                        $AcademicInformation->destroy($academicInformation);
                    }
                }else{
                    $people->academicInformations()->create($academicInformation);
                }
            }
            if(!empty($request->input('historys')) ){
                foreach ($request->input('historys') as $history) {
                    $state = $history['state'];
                    $history = Arr::except($history, ['state']);
                    if($history['id'] && $history['id'] != 'null'){
                        $History = History::find($history['id']);
                        if($state){
                            $History->update($history);
                        }else{
                            $History->destroy($history);
                        }
                    }else{
                        $people->historys()->create($history);
                    }
                }
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();

            return ($this->errorResponse($e->getMessage(), 422));
        }
        return ($this->showWithRelatedModels($people, 200));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\People\People  $people
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $people = People::find($id);
            $people->delete();
            return ($this->successResponse($people, 200));
        } catch (Exception $e) {
            return ($this->errorResponse('No se logro llevar a cabo la operación.', 422));
        }
    }

    /**
     * 
     */
    public function dataTable(Request $request)
    {

        $people = People::with('typeDocument', 'town', 'gender', 'neighborhood', 'occupation', 'typePeople','contacts.contactType','documents.categoryDocument','academicInformations.trainingType','historys.historyType','historys.typePeople','historys.semester','historys.subject');
        if ($request->type_people == 1) {
            $people->whereIn('type_people_id', [1, 2, 3]);
        }
        if ($request->type_people == 2) {
            $people->whereIn('type_people_id', [3, 4, 5, 6, 7, 8, 9]);
        }
        $people->where(function ($query) use ($request) {
            $query->where('names', 'like', '%' . $request->term . '%')
            ->orWhere('surnames', 'like', '%' . $request->term . '%')
                ->orWhere('document_number', 'like', '%' . $request->term . '%')
                ->orWhere('phone', 'like', '%' . $request->term . '%')
                ->orWhere('cell', 'like', '%' . $request->term . '%')
                ->orWhere('email', 'like', '%' . $request->term . '%')
                ->orWhere('address_residence', 'like', '%' . $request->term . '%')
                ->orWhere('rh', 'like', '%' . $request->term . '%')
                ->orWhere('eps', 'like', '%' . $request->term . '%')
                ->orWhere('history', 'like', '%' . $request->term . '%');
        });
        $Query = $people->paginate($request->limit)
            ->toArray();
        return $Query;
    }

    /**
     * 
     */

    public function dependences()
    {
        $controllers = [
            'MasterTables\TypeDocumentController' => ['typeDocuments', 'index'],
            'MasterTables\TypePeopleController' => ['typePeoples', 'index'],
            'MasterTables\TownController' => ['towns', 'index'],
            'MasterTables\NeighborhoodController' => ['neighborhoods', 'index'],
            'MasterTables\OccupationController' => ['occupations', 'index'],
            'MasterTables\GenderController' => ['genders', 'index'],
            'People\ContactTypeController' => ['contactTypes', 'index'],
            'People\CategoryDocumentController' => ['categoryDocuments', 'index'],
            'People\TrainingTypeController' => ['trainingTypes', 'index'],


        ];
        $response = $this->jsonResource($controllers);
        return $response;
    }

    /**
     * COnsulta a las personas segun el tipo o el estado
     */
    public function getPeopleExport(Request $request)
    {

        $people = People::with('typeDocument', 'town', 'gender', 'neighborhood', 'occupation', 'typePeople');
        if ($request->input('enabled') && $request->input('enabled') != 'null') {
            $people->where('enabled', $request->input('enabled'));
        }
        if ($request->input('type_people_id') && $request->input('type_people_id') != "null") {
            $people->where('type_people_id', $request->input('type_people_id'));
        }
        $Query = $people->get();
        return $this->showAll($Query);
    }

    /**
     * Realiza la actualización del estado de la persona
     */

    public function updatePeople(Request $request, $id){
        try {
            $people = People::find($id);
            $people->update($request->all());
            return ($this->successResponse($people, 200));
        } catch (Exception $e) {
            return ($this->errorResponse('No se logro llevar a cabo la operación.', 422));
        }
    }
}
