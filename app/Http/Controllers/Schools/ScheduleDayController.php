<?php

namespace App\Http\Controllers\Schools;

use App\Http\Controllers\Controller;
use App\Models\Schools\{ScheduleDay, ScheduleHour};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;
use App\Models\People\{People};

class ScheduleDayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scheduleDays = ScheduleDay::all()->where('enabled', '1');
        return $this->showAll($scheduleDays);
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

        // $valid = $this->SpecialValidation($request, 'store');
        // if ($valid['exist']) {
        //     return ($this->errorResponse('El grupo ya se encuentra creado para el semestre indicado', 422));
        // }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'group_id' => 'required',
            'day_id' => 'required',
            'scheduleHours' => 'required'
        ]);
        $cammbioNombres = array(
            'scheduleHours' => ' Horas ',
        );
        $validator->setAttributeNames($cammbioNombres);
        if ($validator->fails()) {
            return ($this->errorResponse($validator->errors(), 422));
        }
        try {
            $scheduleDay = new ScheduleDay();
            DB::beginTransaction();
            $scheduleDay = $scheduleDay->create($request->all());
            foreach ($request->input('scheduleHours') as $hour) {
                $scheduleDay->scheduleHours()->create($this->mapHour($hour));
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return ($this->errorResponse($e->getMessage() . 'Se presento un error en el sistema', 422));
        }
        return ($this->showWithRelatedModels($scheduleDay, 200));
    }

    /**
     * Mapea el array para registrar el hobjeto scheduleHour
     */
    public function mapHour($hour)
    {
        $obj = [];
        $obj['hour_id'] = $hour['hour']['id'];
        if ((!empty($hour['subject']) && $hour['subject'] != null)) {
            $obj['subject_id'] = $hour['subject']['id'];
        }
        if ((!empty($hour['people']) && $hour['people'] != null)) {
            $obj['people_id'] = $hour['people']['id'];
        }
        if ((!empty($hour['headquarter']) && $hour['headquarter'] != null)) {
            $obj['headquarter_id'] = $hour['headquarter']['id'];
        }
        return $obj;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schools\ScheduleDay  $scheduleDay
     * @return \Illuminate\Http\Response
     */
    public function show(ScheduleDay $scheduleDay)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schools\ScheduleDay  $scheduleDay
     * @return \Illuminate\Http\Response
     */
    public function edit(ScheduleDay $scheduleDay)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schools\ScheduleDay  $scheduleDay
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ScheduleDay $scheduleDay)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'group_id' => 'required',
            'day_id' => 'required',
            'scheduleHours' => 'required'
        ]);
        $cammbioNombres = array(
            'scheduleHours' => ' Horas ',
        );
        $validator->setAttributeNames($cammbioNombres);
        if ($validator->fails()) {
            return ($this->errorResponse($validator->errors(), 422));
        }
        try {
            DB::beginTransaction();
            $scheduleDay->update($request->all());
            foreach ($request->input('scheduleHours') as $hour) {
                if ($hour['id']) {
                    $scheduleHour = ScheduleHour::find($hour['id']);
                    $scheduleHour->update($this->mapHour($hour));
                } else {
                    $scheduleDay->scheduleHours()->create($this->mapHour($hour));
                }
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return ($this->errorResponse($e->getMessage() . 'Se presento un error en el sistema', 422));
        }
        return ($this->showWithRelatedModels($scheduleDay, 200));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schools\ScheduleDay  $scheduleDay
     * @return \Illuminate\Http\Response
     */
    public function destroy(ScheduleDay $scheduleDay)
    {
        try {
            DB::beginTransaction();
            $scheduleDay->scheduleHours()->delete();
            $scheduleDay->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return ($this->errorResponse($e->getMessage(), 422));
        }
        return ($this->successResponse($scheduleDay, 200));
    }

    /**
     * Cambia el estado del objeto ScheduleDay
     */
    public function stateScheduleDay(Request $request, $day_id){
        try {
            $scheduleDay = ScheduleDay::find($day_id);
            $scheduleDay->enabled = $request['enabled'];
            $scheduleDay->update();
        } catch (Exception $e) {
            return ($this->errorResponse($e->getMessage(), 422));
        }
        return ($this->successResponse($scheduleDay, 200));

    }
}
