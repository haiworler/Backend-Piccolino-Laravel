<?php

namespace App\Http\Controllers\MasterTables;

use App\Http\Controllers\Controller;
use App\Models\MasterTables\Locality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;

class LocalityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $localities = Locality::all()->where('enabled', '1');
        return $this->showAll($localities);
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
            $locality = new Locality();
            DB::beginTransaction();
            $locality->create($request->all());
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return ($this->errorResponse('Se presento un error en el sistema', 422));
        }
        return ($this->showWithRelatedModels($locality, 200));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterTables\Locality  $locality
     * @return \Illuminate\Http\Response
     */
    public function show(Locality $locality)
    {
        //
    }

   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterTables\Locality  $locality
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Locality $locality)
    {
        try {
            DB::beginTransaction();
            $locality->update($request->all());
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return ($this->errorResponse('Se presento un error en el sistema', 422));
        }
        return ($this->showWithRelatedModels($locality, 200));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterTables\Locality  $locality
     * @return \Illuminate\Http\Response
     */
    public function destroy(Locality $locality)
    {
        try {
            $locality->delete();
        } catch (Exception $e) {
            return ($this->errorResponse($e->getMessage(), 422));
        }
        return ($this->successResponse($locality, 200));
    }

     /**
     * Para el listar de las localidades
     */
    public function dataTable(Request $request)
    {
        $localities = Locality::with('town')->Where('name', 'like', '%' . $request->term . '%')
            ->paginate($request->limit)
            ->toArray();
        return $this->showDatatable($localities);
    }

    /**
     * Departamentos - Dependencias
     * Listado, de dependecias para el formulario
     * @group Tablas Maestras
     * @return \Illuminate\Http\Response
     */
    public function dependences()
    {
        $controllers = [
            'MasterTables\TownController' => ['towns', 'index']
        ];
        $response = $this->jsonResource($controllers);
        return $response;
    }
}
