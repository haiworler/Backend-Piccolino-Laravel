<?php

namespace App\Http\Controllers\Schools;

use App\Http\Controllers\Controller;
use App\Models\Schools\Competencie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;

class CompetencieController extends Controller
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
     * @param  \App\Models\Schools\Competencie  $competencie
     * @return \Illuminate\Http\Response
     */
    public function show(Competencie $competencie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schools\Competencie  $competencie
     * @return \Illuminate\Http\Response
     */
    public function edit(Competencie $competencie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schools\Competencie  $competencie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Competencie $competencie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schools\Competencie  $competencie
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $competencie = Competencie::find($id);
            $competencie = $competencie->delete();
          } catch (Exception $e) {
            return ($this->errorResponse($e->getMessage(), 422));
          }
          return ($this->successResponse($competencie, 200));
    }
}
