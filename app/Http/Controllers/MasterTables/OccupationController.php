<?php

namespace App\Http\Controllers\MasterTables;

use App\Http\Controllers\Controller;
use App\Models\MasterTables\Occupation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;

class OccupationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $occupations = Occupation::all()->where('enabled', '1');
        return $this->showAll($occupations);
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $occupation = new Occupation();
            $occupation->create($request->all());
        } catch (Exception $e) {
            return ($this->errorResponse('Se presento un error en el sistema', 422));
        }
        return ($this->showWithRelatedModels($occupation, 200));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterTables\Occupation  $occupation
     * @return \Illuminate\Http\Response
     */
    public function show(Occupation $occupation)
    {
        //
    }

   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterTables\Occupation  $occupation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Occupation $occupation)
    {
        try {
            $occupation->update($request->all());
        } catch (Exception $e) {
            return ($this->errorResponse('Se presento un error en el sistema', 422));
        }
        return ($this->showWithRelatedModels($occupation, 200));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterTables\Occupation  $occupation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Occupation $occupation)
    {
        try {
            $occupation->delete();
        } catch (Exception $e) {
            return ($this->errorResponse($e->getMessage(), 422));
        }
        return ($this->successResponse($occupation, 200));
    }

     /**
     * Para el listar de loas ocupaciones del tercero
     */
    public function dataTable(Request $request)
    {
        $occupations = Occupation::Where('name', 'like', '%' . $request->term . '%')
            ->paginate($request->limit)
            ->toArray();
        return $this->showDatatable($occupations);
    }
}
