<?php

namespace App\Http\Controllers\Security;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all()->where('enabled', '1');
        return $this->showAll($users);
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
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'profile_id' => 'required',
            'people_id' => 'required',
        ]);
        if ($validator->fails()) {
            return ($this->errorResponse($validator->errors(), 422));
        }
        try {
            $user = new User();
            $request['password'] = Hash::make($request->input('password'));
            DB::beginTransaction();
            $user = $user->create($request->all());
            $user->people()->attach($request->input('people_id'));
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return ($this->errorResponse($e->getMessage() . 'Se presento un error en el sistema', 422));
        }
        return ($this->showWithRelatedModels($user, 200));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $user->id,
            'password' => 'required',
            'profile_id' => 'required',
            'people_id' => 'required',
        ]);
        if ($validator->fails()) {
            return ($this->errorResponse($validator->errors(), 422));
        }
        if ($request['password'] != $user->password) {
            $request['password'] = Hash::make($request->input('password'));
        }
        try {
            DB::beginTransaction();
            $user->update($request->all());
            $user->people()->sync($request->input('people_id'));
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return ($this->errorResponse($e->getMessage() . 'Se presento un error en el sistema', 422));
        }
        return ($this->showWithRelatedModels($user, 200));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
        } catch (Exception $e) {
            return ($this->errorResponse($e->getMessage(), 422));
        }
        return ($this->successResponse($user, 200));
    }

    /**
     * Para el listar de los semestres
     */
    public function dataTable(Request $request)
    {
        $users = User::with('profile.modules', 'people')
            ->where('name', 'like', '%' . $request->term . '%')
            ->paginate($request->limit)
            ->toArray();
        return $this->showDatatable($users);
    }

    /**
     * 
     */
    public function dependences()
    {
        $controllers = [
            'Security\ProfileController' => ['profiles', 'index'],
        ];
        $response = $this->jsonResource($controllers);
        return $response;
    }
}
