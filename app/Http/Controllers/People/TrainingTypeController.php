<?php

namespace App\Http\Controllers\People;

use App\Http\Controllers\Controller;
use App\Models\People\TrainingType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;

class TrainingTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trainingTypes = TrainingType::all()->where('enabled', '1');
        return $this->showAll($trainingTypes);
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
            $trainingType = new TrainingType();
            $trainingType->create($request->all());
        } catch (Exception $e) {
            return ($this->errorResponse('Se presento un error en el sistema', 422));
        }
        return ($this->showWithRelatedModels($trainingType, 200));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\People\TrainingType  $trainingType
     * @return \Illuminate\Http\Response
     */
    public function show(TrainingType $trainingType)
    {
        //
    }

  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\People\TrainingType  $trainingType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TrainingType $trainingType)
    {
        try {
            $trainingType->update($request->all());
        } catch (Exception $e) {
            return ($this->errorResponse('Se presento un error en el sistema', 422));
        }
        return ($this->showWithRelatedModels($trainingType, 200));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\People\TrainingType  $trainingType
     * @return \Illuminate\Http\Response
     */
    public function destroy(TrainingType $trainingType)
    {
        try {
            $trainingType->delete();
        } catch (Exception $e) {
            return ($this->errorResponse($e->getMessage(), 422));
        }
        return ($this->successResponse($trainingType, 200));
    }

    /**
     * Para el listar de los niveles academicos
     */
    public function dataTable(Request $request)
    {
        $trainingTypes = TrainingType::Where('name', 'like', '%' . $request->term . '%')
            ->paginate($request->limit)
            ->toArray();
        return $this->showDatatable($trainingTypes);
    }
}
