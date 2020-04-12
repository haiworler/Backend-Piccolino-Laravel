<?php

namespace App\Http\Controllers\Schools;

use App\Http\Controllers\Controller;
use App\Models\Schools\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $semesters = Semester::all()->where('enabled', '1');
        return $this->showAll($semesters);
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
            'start_date' => 'required',
            'code' => 'required|unique:subjects',
            'end_date' => 'required',
            'cuts'=> 'required'

        ]);
        $cammbioNombres = array(
            'code' => 'Nombre de la signatura',
        );

        $validator->setAttributeNames($cammbioNombres);
        if ($validator->fails()) {
            return ($this->errorResponse($validator->errors(), 422));
        }
        try {
            $semester = new Semester();
            DB::beginTransaction();
            $semester = $semester->create($request->all());
            $semester->cuts()->attach(Array_values($request->get('cuts')));
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return ($this->errorResponse($e->getMessage() . 'Se presento un error en el sistema', 422));
        }
        return ($this->showWithRelatedModels($semester, 200));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schools\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function show(Semester $semester)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schools\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function edit(Semester $semester)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schools\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Semester $semester)
    {
        try {
            DB::beginTransaction();
            $semester->update($request->all());
            $semester->cuts()->sync(Array_values($request->get('cuts')));
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return ($this->errorResponse('Se presento un error en el sistema', 422));
        }
        return ($this->showWithRelatedModels($semester, 200));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schools\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function destroy(Semester $semester)
    {
        try {
            $semester->delete();
        } catch (Exception $e) {
            return ($this->errorResponse($e->getMessage(), 422));
        }
        return ($this->successResponse($semester, 200));
    }

    /**
     * Para el listar de los semestres
     */
    public function dataTable(Request $request)
    {
        $subjects = Semester::with('cuts')->where('code', 'like', '%' . $request->term . '%')
            ->paginate($request->limit)
            ->toArray();
        return $this->showDatatable($subjects);
    }

      /**
     * 
     */
    public function dependences()
    {
        $controllers = [
            'MasterTables\CutController' => ['cuts', 'index'],
        ];
        $response = $this->jsonResource($controllers);
        return $response;
    }
}
