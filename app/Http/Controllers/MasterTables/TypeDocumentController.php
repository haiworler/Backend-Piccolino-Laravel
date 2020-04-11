<?php

namespace App\Http\Controllers\MasterTables;

use App\Http\Controllers\Controller;
use App\Models\MasterTables\TypeDocument;
use Illuminate\Http\Request;

class TypeDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typeDocuments = TypeDocument::all()->where('enabled', '1');
        return $this->showAll($typeDocuments);
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
     * @param  \App\Models\MasterTables\TypeDocument  $typeDocument
     * @return \Illuminate\Http\Response
     */
    public function show(TypeDocument $typeDocument)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterTables\TypeDocument  $typeDocument
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeDocument $typeDocument)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterTables\TypeDocument  $typeDocument
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeDocument $typeDocument)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterTables\TypeDocument  $typeDocument
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeDocument $typeDocument)
    {
        //
    }
}
