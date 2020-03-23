<?php

namespace App\Http\Controllers\MasterTables;

use App\Http\Controllers\Controller;
use App\Models\MasterTables\Neighborhood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;

class NeighborhoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $neighborhoods = Neighborhood::all()->where('enabled', '1');
        return $this->showAll($neighborhoods);
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
            'locality_id' => 'required|numeric'
        ]);
        $cammbioNombres = array(
            'name' => 'Nombre del barrrio',
        );
        $validator->setAttributeNames($cammbioNombres);
        if ($validator->fails()) {
            return ($this->errorResponse($validator->errors(), 422));
        }
        try {
            $neighborhood = new Neighborhood();
            $neighborhood->create($request->all());
            return ($this->showWithRelatedModels($neighborhood, 200));
        } catch (Exception $e) {
            return ($this->errorResponse('No se logro llevar a cabo la operación.', 422));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterTables\Neighborhood  $neighborhood
     * @return \Illuminate\Http\Response
     */
    public function show(Neighborhood $neighborhood)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterTables\Neighborhood  $neighborhood
     * @return \Illuminate\Http\Response
     */
    public function edit(Neighborhood $neighborhood)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterTables\Neighborhood  $neighborhood
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Neighborhood $neighborhood)
    {

        try {
            $neighborhood->update($request->all());
        } catch (Exception $e) {
            return ($this->errorResponse('No se logro llevar a cabo la operación.', 422));
        }
        return ($this->showWithRelatedModels($neighborhood, 200));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterTables\Neighborhood  $neighborhood
     * @return \Illuminate\Http\Response
     */
    public function destroy(Neighborhood $neighborhood)
    {
        try {
            $neighborhood->delete();
            return ($this->successResponse($neighborhood, 200));
        } catch (Exception $e) {
            return ($this->errorResponse('No se logro llevar a cabo la operación.', 422));
        }
    }

    public function dataTable(Request $request)
    {
        $neighborhoods = Neighborhood::with('locality')
            ->where('name', 'like', '%' . $request->term . '%')
            ->orWhereHas('locality', function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->term . '%');
            })
            ->paginate($request->limit)
            ->toArray();
        return $neighborhoods;
    }

    public function dependences()
    {
        $controllers = [
            'MasterTables\LocalityController' => ['localities', 'index']
        ];
        $response = $this->jsonResource($controllers);
        return $response;
    }
}
