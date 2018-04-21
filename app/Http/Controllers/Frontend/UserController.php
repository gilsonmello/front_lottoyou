<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\User\CreateUserRequest;
use App\Http\Requests\Frontend\User\UpdateUserRequest;
use App\User;
use App\Balance;

class UserController extends Controller
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
    public function store(CreateUserRequest $request)
    {
        $user = new User;
        $user->name = $request->get('name');
        $user->last_name = $request->get('last_name');
        $user->username = $request->get('email');
        $user->laravel_password = bcrypt($request->get('password'));
        $user->password = '';
        $user->group_id = 3;
        $user->gel_empresa_id = 8;
        $user->birth_day = (int) $request->get('birth_day') < 10 ? '0'.$request->get('birth_day') : $request->get('birth_day');
        $user->birth_month = $request->get('birth_month');
        $user->birth_year = $request->get('birth_year');
        $user->country_id = $request->get('country');
        $user->gender = $request->get('gender');
        if($user->save()) {

            Balance::create([
                'user_id' => $user->id,
                'value' => 0.00,
            ]);
            
            return response()->json(['message' => trans('alerts.users.create.success')], 200);
        }

        return response()->json(['message' => trans('alerts.users.create.error')], 422);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::find($id);
        if($request->get('password') != null && !empty($request->get('password'))) {
            $user->laravel_password = bcrypt($request->get('password'));
        }
        $user->street = $request->get('street');
        $user->number = $request->get('number');
        $user->cep = $request->get('cep');
        $user->city = $request->get('city');
        $user->complement = $request->get('complement');
        $user->username = $request->get('username');
        $user->state = $request->get('state');
        $user->tell_phone = $request->get('tell_phone');
        if($user->save()){
            return response()->json(['message' => trans('alerts.users.update.success')], 200);
        }
        return response()->json(['message' => trans('alerts.users.update.error')], 422);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
