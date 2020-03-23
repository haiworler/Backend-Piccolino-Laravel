<?php

  namespace App\Traits;

  use Illuminate\Database\Eloquent\Model;
  use Illuminate\Support\Collection;

  trait JsonResponseTrait {

    function jsonResource(Array $controllers) {
      $response = [];
      foreach($controllers as $key => $value) {

        foreach($value as $key1 => $value1) {
            if(is_array($value1) && count($value1) > 1) {
            try {
              $method = $value1[1];
              if(isset($value1[2])) {
                $model = app('App\Http\Controllers\\'.$key)->$method($value1[2]);
              } else {
                $model = app('App\Http\Controllers\\'.$key)->$method();
              }
              if(isset($model->original)) {
                $response[$value1[0]] = $model->original['data'];
              } else {
                $response[$value1[0]] = $model;
              }
            } catch(\Exception $e) {
               // dd($e);
              $response[$value1[0]] = null;
            }

          } else {
            try {
              $method = $value[1];
              if(isset($value[2])) {
                $model = app('App\Http\Controllers\\'.$key)->$method($value[2]);
              } else {
                $model = app('App\Http\Controllers\\'.$key)->$method();
              }
              if(isset($model->original)) {
                $response[$value[0]] = $model->original['data'];
              } else {
                $response[$value[0]] = $model;
              }
            } catch(\Exception $e) {
              $response[$value[0]] = null;
            }
          }

        }
      }
      return $response;
    }
  }
