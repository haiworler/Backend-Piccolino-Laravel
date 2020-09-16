<?php

namespace App\Http\Controllers\MasterTables;

use App\Http\Controllers\Controller;
use App\Models\MasterTables\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::all()->where('enabled', '1');
        return $this->showAll($departments);
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
            $department = new Department();
            DB::transaction(function () use ($request, &$department) {
                $department->create($request->all());
            });
            return ($this->showWithRelatedModels($department, 200));
        } catch (Exception $e) {
            return ($this->errorResponse('No se logro llevar a cabo la operación.', 422));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterTables\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterTables\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        try {

            DB::transaction(function () use ($request, &$department) {
                $department->update($request->all());
            });
        } catch (Exception $e) {
            return ($this->errorResponse('No se logro llevar a cabo la operación.', 422));
        }
        return ($this->showWithRelatedModels($department, 200));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterTables\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        try {
            DB::transaction(function () use (&$department) {
                $department->delete();
            });
            return ($this->successResponse($department, 200));
        } catch (Exception $e) {
            return ($this->errorResponse('No se logro llevar a cabo la operación.', 422));
        }
    }


    /**
     * Departamentos - Datatable
     * Listado, apto para dataTable
     * Consula los datos del recurso los retorna junto a los valores necesarios para la paginacion
     * @group Tablas Maestras
     * @bodyParam term  Texto Filtros Datos para la realización de filtros, se utiliza un mismo dato para todos los filtros
     * @return \Illuminate\Http\Response
     */
    public function dataTable(Request $request)
    {
        $departments = Department::with('country')
            ->where('name', 'like', '%' . $request->term . '%')
            ->orWhereHas('country', function ($query) use ($request) {
                return $query->where('id',$request->country)->where('name', 'like', '%' . $request->term . '%');                                                                                                                                                                                                                                       
            })
            ->paginate($request->limit)
             ->toArray();
        return $departments;
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
            'MasterTables\CountryController' => ['countries', 'index']
        ];
        $response = $this->jsonResource($controllers);
        return $response;
    }

    /**
     * Departamentos - Obtener departamentos
     * Listado de departamentos por país     *
     * @group Tablas Maestras
     * @urlParam id required País sobre el cual se va a realizar selección de información
     * @return \Illuminate\Http\Response
     */
    public function getDepartments($country_id)
    {
        $departments = Department::where('country_id', $country_id)->get();
        return $this->showAll($departments);
    }
}
