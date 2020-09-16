<?php

namespace App\Http\Controllers\MasterTables;

use App\Http\Controllers\Controller;
use App\Models\MasterTables\Town;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Exception;

class TownController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $towns = Town::all()->where('enabled', '1');
        return $this->showAll($towns);
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
            $town = new Town();
            DB::transaction(function () use ($request, &$town) {
                $town->create($request->all());
            });
        } catch (Exception $e) {
            return ($this->errorResponse('No se logro llevar a cabo la operación.', 422));
        }
        return ($this->showWithRelatedModels($town, 200));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterTables\Town  $town
     * @return \Illuminate\Http\Response
     */
    public function show(Town $town)
    {
        //
    }

  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterTables\Town  $town
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Town $town)
    {
        try {

            DB::transaction(function () use ($request, &$town) {
                $town->update($request->all());
            });
        } catch (Exception $e) {
            return ($this->errorResponse('No se logro llevar a cabo la operación.', 422));
        }

        return ($this->showWithRelatedModels($town, 200));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterTables\Town  $town
     * @return \Illuminate\Http\Response
     */
    public function destroy(Town $town)
    {
        try {
            DB::transaction(function () use (&$town) {
                $town->delete();
            });
            return ($this->successResponse($town, 200));
        } catch (Exception $e) {
            return ($this->errorResponse('No se logro llevar a cabo la operación.', 422));
        }
    }

      /**
     * Ciudades - Datatable
     * Listado, apto para dataTable
     * Consula los datos del recurso los retorna junto a los valores necesarios para la paginacion
     * @group Tablas Maestras
     * @bodyParam term required Filtros Datos para la realización de filtros, se utiliza un mismo dato para todos los filtros
     * @return \Illuminate\Http\Response
     */
    public function dataTable(Request $request)
    {
        $towns = Town::with('department.country')
            ->where('name', 'like', '%' . $request->term . '%')
            ->orWhereHas('department', function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->term . '%');
            })
            ->orWhereHas('department.country', function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->term . '%');
            })
            ->paginate($request->limit)
            ->toArray();
        return $towns;
    }

     /**
     * Ciudades - Dependecias
     * Listado, de dependecias para el formulario
     * @group Tablas Maestras
     * @return \Illuminate\Http\Response
     */
    public function dependences()
    {
        $controllers = [
            'MasterTables\CountryController' => ['countries', 'index']
        ];
        $response = $this->jsonResource($controllers);
        return $response;
    }

     /**
     * Ciudades - Colección
     * Ciudades de acuerdo a un departamento
     * @group Tablas Maestras
     * @urlParam id required Id del departamento para obtener las ciudades
     * @return \Illuminate\Http\Response
     */
    public function getTowns($department_id)
    {
        $towns = Town::where('department_id', $department_id)->get();
        return $this->showAll($towns);
    }

}
