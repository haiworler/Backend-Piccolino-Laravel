<?php

namespace App\Http\Controllers\MasterTables;

use App\Http\Controllers\Controller;
use App\Models\MasterTables\TypePeople;
use Illuminate\Http\Request;

class TypePeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typePeoples = TypePeople::all()->where('enabled', '1');
        return $this->showAll($typePeoples);
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
     * @param  \App\Models\MasterTables\TypePeople  $typePeople
     * @return \Illuminate\Http\Response
     */
    public function show(TypePeople $typePeople)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterTables\TypePeople  $typePeople
     * @return \Illuminate\Http\Response
     */
    public function edit(TypePeople $typePeople)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterTables\TypePeople  $typePeople
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypePeople $typePeople)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterTables\TypePeople  $typePeople
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypePeople $typePeople)
    {
        //
    }
}
