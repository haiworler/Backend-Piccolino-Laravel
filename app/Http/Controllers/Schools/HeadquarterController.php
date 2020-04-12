<?php

namespace App\Http\Controllers\Schools;

use App\Http\Controllers\Controller;
use App\Models\Schools\Headquarter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;

class HeadquarterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $headquarters = Headquarter::all()->where('enabled', '1');
        return $this->showAll($headquarters);
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
            'neighborhood_id' => 'required|numeric'
        ]);
        $cammbioNombres = array(
            'name' => 'Nombre de la sede',
        );
        $validator->setAttributeNames($cammbioNombres);
        if ($validator->fails()) {
            return ($this->errorResponse($validator->errors(), 422));
        }
        try {
            $headquarter = new Headquarter();
            $headquarter->create($request->all());
            return ($this->showWithRelatedModels($headquarter, 200));
        } catch (Exception $e) {
            return ($this->errorResponse('No se logro llevar a cabo la operación.' . $e->getMessage(), 422));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schools\Headquarter  $headquarter
     * @return \Illuminate\Http\Response
     */
    public function show(Headquarter $headquarter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schools\Headquarter  $headquarter
     * @return \Illuminate\Http\Response
     */
    public function edit(Headquarter $headquarter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schools\Headquarter  $headquarter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Headquarter $headquarters)
    {
        try {
            $headquarters->update($request->all());
        } catch (Exception $e) {
            return ($this->errorResponse('No se logro llevar a cabo la operación.', 422));
        }
        return ($this->showWithRelatedModels($headquarters, 200));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schools\Headquarter  $headquarter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Headquarter $headquarter)
    {
        try {
            $headquarter->delete();
            return ($this->successResponse($headquarter, 200));
        } catch (Exception $e) {
            return ($this->errorResponse('No se logro llevar a cabo la operación.', 422));
        }
    }

    public function dataTable(Request $request)
    {
        $headquarters = Headquarter::with('neighborhood')
            ->where('name', 'like', '%' . $request->term . '%')
            ->orWhereHas('neighborhood', function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->term . '%');
            })
            ->paginate($request->limit)
            ->toArray();
        return $headquarters;
    }

    public function dependences()
    {
        $controllers = [
            'MasterTables\NeighborhoodController' => ['neighborhoods', 'index']
        ];
        $response = $this->jsonResource($controllers);
        return $response;
    }
}
