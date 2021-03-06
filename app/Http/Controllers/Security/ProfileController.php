<?php

namespace App\Http\Controllers\Security;

use App\Http\Controllers\Controller;
use App\Models\Security\{Profile};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = Profile::all()->where('enabled', '1');
        return $this->showAll($profiles);
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
            'name' => 'required|unique:profiles',
        ]);
        if ($validator->fails()) {
            return ($this->errorResponse($validator->errors(), 422));
        }
        try {
            $profile = new Profile();
            DB::beginTransaction();
            $profile = $profile->create($request->all());
            if(count($request->input('modules'))){
                $profile->modules()->attach(Array_values($request->get('modules')));
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return ($this->errorResponse($e->getMessage() . 'Se presento un error en el sistema', 422));
        }
        return ($this->showWithRelatedModels($profile, 200));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Security\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Security\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Security\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return ($this->errorResponse($validator->errors(), 422));
        }
        try {
            DB::beginTransaction();
             $profile->update($request->all());
            if(count($request->input('modules'))){
                $profile->modules()->sync(Array_values($request->get('modules')));
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return ($this->errorResponse($e->getMessage() . 'Se presento un error en el sistema', 422));
        }
        return ($this->showWithRelatedModels($profile, 200));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Security\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        try {
            $profile->delete();
        } catch (Exception $e) {
            return ($this->errorResponse($e->getMessage(), 422));
        }
        return ($this->successResponse($profile, 200));
    }


     /**
     * Para el listar de los semestres
     */
    public function dataTable(Request $request)
    {
        $profiles = Profile::with('modules')
        ->where('name', 'like', '%' . $request->term . '%')
            ->paginate($request->limit)
            ->toArray();
        return $this->showDatatable($profiles);
    }


      /**
     * 
     */
    public function dependences()
    {
        $controllers = [
            'Security\ModuleController' => ['modules', 'index',1],
        ];
        $response = $this->jsonResource($controllers);
        return $response;
    }
}
