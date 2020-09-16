<?php

namespace App\Http\Controllers\MasterTables;

use App\Http\Controllers\Controller;
use App\Models\MasterTables\{Country,Department};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;


class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all()->where('enabled', '1');
        return $this->showAll($countries);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $country = new Country();
            DB::transaction(function() use ($request, &$country){
                $country->create($request->all());
            });
            return ($this->showWithRelatedModels($country, 200));
        }catch(Exception $e){
            return ($this->errorResponse($e->getMessage(), 422));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterTables\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterTables\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterTables\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        try{
            DB::transaction(function() use ($request, &$country){
                $country->update($request->all());
            });
        }catch(Exception $e){
            return ($this->errorResponse($e->getMessage(), 422));
        }

        return ($this->showWithRelatedModels($country, 200));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterTables\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        try{
            DB::transaction(function() use (&$country) {
                $country->delete();
            });
            return ($this->successResponse($country, 200));
        }
        catch(Exception $e){
            return ($this->errorResponse($e->getMessage(), 422));
        }
    }

     /**
     * Paises - Datatable
     * Listado, apto para dataTable
     * Consula los datos del recurso los retorna junto a los valores necesarios para la paginacion     *
     * @group Tablas Maestras
     * @bodyParam term  Texto Filtros Datos para la realización de filtros, se utiliza un mismo dato para todos los filtros
     * @return \Illuminate\Http\Response
     */
    public function dataTable(Request $request){
        $countries = Country::
          where('name', 'like', '%'.$request->term.'%')
        ->paginate($request->limit)
        ->toArray();
        return $this->showDataTable($countries);
    }

      /**
     * Paises - Departamentos
     * Listado de departamentos por país
     * Consula los datos del recurso los retorna junto a los valores necesarios para la paginacion
     * @group Tablas Maestras
     * @bodyParam id Texto required Id del país para la consulta de sus departamentos.
     * @return \Illuminate\Http\Response
     */
    public function departments($id){
        $departments = Department::where('country_id', $id)->get();
        return $this->showAll($departments);
    }
}
