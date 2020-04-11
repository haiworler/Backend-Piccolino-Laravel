<?php

namespace App\Http\Controllers\Schools;

use App\Http\Controllers\Controller;
use App\Models\Schools\{Subject,Competencie};
use App\Models\People\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::all()->where('enabled', '1');
        return $this->showAll($subjects);
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
            'name' => 'required',
            'code' => 'required|unique:subjects',
            'credits' => 'required'

        ]);
        $cammbioNombres = array(
            'name' => 'Nombre de la signatura',
        );
        $validator->setAttributeNames($cammbioNombres);
        if ($validator->fails()) {
            return ($this->errorResponse($validator->errors(), 422));
        }
        try {
            $subject = new Subject();
            DB::beginTransaction();
            $subject = $subject->create($request->all());
            if (count($request->input('competencies'))) {
                foreach($request->input('competencies') as $competencie){
                    $subject->competencies()->create($competencie);
                }
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return ($this->errorResponse($e->getMessage(), 422));
        }
        return ($this->showWithRelatedModels($subject, 200));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schools\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schools\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schools\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        try {
             $subject->update($request->all());
            if (count($request->input('competencies'))) {
                foreach($request->input('competencies') as $competencie){
                    $Competencie = Competencie::find($competencie['id']);
                    if($Competencie){
                        $Competencie->update($competencie);
                    }else{
                        $subject->competencies()->create($competencie); 
                    }
                }
            }
        } catch (Exception $e) {
            return ($this->errorResponse('No se logro llevar a cabo la operación.', 422));
        }
        return ($this->successResponse($subject, 200));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schools\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        try {
            $subject = $subject->delete();
          } catch (Exception $e) {
            return ($this->errorResponse($e->getMessage(), 422));
          }
          return ($this->successResponse($subject, 200));
    }

    public function dataTable(Request $request)
    {
        $subjects = Subject::with('competencies','people')
            ->orWhere('name', 'like', '%' . $request->term . '%')
            ->orWhereHas('competencies', function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->term . '%');
            })
            ->paginate($request->limit)
            ->toArray();
        return $this->showDatatable($subjects);
    }
      /**
     * Consulta a las personas cuyo tipo sea profesor 
     */
    public function getTeachers()
    {
        $peoples = People::where('enabled', '1')->where('type_people_id', 4)->get();
        return $peoples;
    }


    public function assignTeacher(Request $request,$id){
        try {
            $subject = Subject::find($id);
            DB::beginTransaction();
            $subject->people()->sync($request->get('people'));
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return ($this->errorResponse('Se presento un error en el sistema', 422));
          }
          return ($this->showWithRelatedModels($subject, 200));
    }
}
