<?php

namespace App\Http\Controllers\People;

use App\Http\Controllers\Controller;
use App\Models\People\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;

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
        $validator = Validator::make($request->all(), [
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
            $people = new People();
            $people->create($request->all());
            return ($this->showWithRelatedModels($people, 200));
        } catch (Exception $e) {
            return ($this->errorResponse('No se logro llevar a cabo la operación.', 422));
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
            $people = People::find($id);
            $people->update($request->all());
        } catch (Exception $e) {
            return ($this->errorResponse('No se logro llevar a cabo la operación.', 422));
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

        $people = People::with('typeDocument', 'town', 'gender', 'neighborhood', 'occupation', 'typePeople');
        if ($request->type_people == 1) {
            $people->whereIn('type_people_id', [1, 2]);
        }
        if ($request->type_people == 2) {
            $people->whereIn('type_people_id', [3, 4, 5]);
        }
        $people->where('names', 'like', '%' . $request->term . '%');

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
        ];
        $response = $this->jsonResource($controllers);
        return $response;
    }
}
