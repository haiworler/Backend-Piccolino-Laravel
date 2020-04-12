<?php

namespace App\Http\Controllers\MasterTables;

use App\Http\Controllers\Controller;
use App\Models\MasterTables\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades = Grade::where('enabled', '1')->get();
        return $this->showAll($grades);
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
            'name' => 'required'

        ]);
        $cammbioNombres = array(
            'name' => 'Nombre del grado',
        );

        $validator->setAttributeNames($cammbioNombres);
        if ($validator->fails()) {
            return ($this->errorResponse($validator->errors(), 422));
        }
        try {
            $grade = new Grade();
            DB::beginTransaction();
            $grade->create($request->all());
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return ($this->errorResponse('Se presento un error en el sistema', 422));
        }
        return ($this->showWithRelatedModels($grade, 200));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterTables\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterTables\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function edit(Grade $grade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterTables\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grade $grade)
    {
        try {
            DB::beginTransaction();
            $grade->update($request->all());
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return ($this->errorResponse('Se presento un error en el sistema', 422));
        }
        return ($this->showWithRelatedModels($grade, 200));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterTables\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grade $grade)
    {
        try {
            $grade->delete();
        } catch (Exception $e) {
            return ($this->errorResponse($e->getMessage(), 422));
        }
        return ($this->successResponse($grade, 200));
    }

    /**
     * Para el listar de los grados
     */
    public function dataTable(Request $request)
    {
        $grades = Grade::orWhere('name', 'like', '%' . $request->term . '%')
            ->paginate($request->limit)
            ->toArray();
        return $this->showDatatable($grades);
    }
}
