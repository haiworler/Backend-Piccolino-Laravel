<?php

namespace App\Http\Controllers\Schools;

use App\Http\Controllers\Controller;
use App\Models\Schools\ScheduleHour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;

class ScheduleHourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schools\ScheduleHour  $scheduleHour
     * @return \Illuminate\Http\Response
     */
    public function show(ScheduleHour $scheduleHour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schools\ScheduleHour  $scheduleHour
     * @return \Illuminate\Http\Response
     */
    public function edit(ScheduleHour $scheduleHour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schools\ScheduleHour  $scheduleHour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ScheduleHour $scheduleHour)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schools\ScheduleHour  $scheduleHour
     * @return \Illuminate\Http\Response
     */
    public function destroy(ScheduleHour $scheduleHour)
    {
        try {
            $scheduleHour->delete();
        } catch (Exception $e) {
            return ($this->errorResponse($e->getMessage(), 422));
        }
        return ($this->successResponse($scheduleHour, 200));
    }
}
