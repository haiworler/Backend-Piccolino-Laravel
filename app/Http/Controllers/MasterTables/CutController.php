<?php

namespace App\Http\Controllers\MasterTables;

use App\Http\Controllers\Controller;
use App\Models\MasterTables\Cut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;

class CutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cuts = Cut::where('enabled', '1')->get();
        return $this->showAll($cuts);
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
            'name' => 'Nombre del corte',
        );

        $validator->setAttributeNames($cammbioNombres);
        if ($validator->fails()) {
            return ($this->errorResponse($validator->errors(), 422));
        }
        try {
            $cut = new Cut();
            DB::beginTransaction();
            $cut->create($request->all());
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return ($this->errorResponse('Se presento un error en el sistema', 422));
        }
        return ($this->showWithRelatedModels($cut, 200));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterTables\Cut  $cut
     * @return \Illuminate\Http\Response
     */
    public function show(Cut $cut)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterTables\Cut  $cut
     * @return \Illuminate\Http\Response
     */
    public function edit(Cut $cut)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterTables\Cut  $cut
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cut $cut)
    {
        try {
            DB::beginTransaction();
            $cut->update($request->all());
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return ($this->errorResponse('Se presento un error en el sistema', 422));
        }
        return ($this->showWithRelatedModels($cut, 200));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterTables\Cut  $cut
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cut $cut)
    {
        try {
            $cut->delete();
        } catch (Exception $e) {
            return ($this->errorResponse($e->getMessage(), 422));
        }
        return ($this->successResponse($cut, 200));
    }

     /**
     * Para el listar de los cortes
     */
    public function dataTable(Request $request)
    {
        $cut = Cut::orWhere('name', 'like', '%' . $request->term . '%')
            ->paginate($request->limit)
            ->toArray();
        return $this->showDatatable($cut);
    }
}
