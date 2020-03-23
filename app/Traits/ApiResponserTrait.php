<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait apiResponserTrait {

    function successResponse($data, $code = 200) {
        return response()->json($data, $code);
    }

    
    function errorResponse($message, $code) {
        return response()->json(['message' => $message, 'code' => $code], $code);
    }

    function showOne(Model $instance, $code = 200) {
        return $this->successResponse($instance, $code);
    }

    function showAll(Collection $collection, $code = 200) {
        return $this->successResponse(['data' => $collection], $code);
    }

    function showWithRelatedModels($modelWithRelatedModels, $code = 200) {
        return $this->successResponse(['data' => $modelWithRelatedModels], $code);
    }
    
    function showMany(Array $modelList, $code = 200) {
        return $this->successResponse(['data' => $modelList], $code);
    }

    function showDataTable(Array $data, $code = 200) {
        return $this->successResponse($data, $code);
    } 
}
