<?php

namespace App\Http\Controllers\People;

use App\Http\Controllers\Controller;
use App\Models\People\CategoryDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;

class CategoryDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoryDocuments = CategoryDocument::all()->where('enabled', '1');
        return $this->showAll($categoryDocuments);
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
            $categoryDocument = new CategoryDocument();
            $categoryDocument->create($request->all());
        } catch (Exception $e) {
            return ($this->errorResponse('Se presento un error en el sistema', 422));
        }
        return ($this->showWithRelatedModels($categoryDocument, 200));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\People\CategoryDocument  $categoryDocument
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryDocument $categoryDocument)
    {
        //
    }

   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\People\CategoryDocument  $categoryDocument
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoryDocument $categoryDocument)
    {
        try {
            $categoryDocument->update($request->all());
        } catch (Exception $e) {
            return ($this->errorResponse('Se presento un error en el sistema', 422));
        }
        return ($this->showWithRelatedModels($categoryDocument, 200));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\People\CategoryDocument  $categoryDocument
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryDocument $categoryDocument)
    {
        try {
            $categoryDocument->delete();
        } catch (Exception $e) {
            return ($this->errorResponse($e->getMessage(), 422));
        }
        return ($this->successResponse($categoryDocument, 200));
    }

    /**
     * Para el listar de los documentos de identificación
     */
    public function dataTable(Request $request)
    {
        $categoryDocuments = CategoryDocument::Where('name', 'like', '%' . $request->term . '%')
            ->paginate($request->limit)
            ->toArray();
        return $this->showDatatable($categoryDocuments);
    }
}
