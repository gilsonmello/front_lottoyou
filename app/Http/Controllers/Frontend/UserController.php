<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\User\CreateUserRequest;
use App\Http\Requests\Frontend\User\UpdateUserRequest;
use App\User;
use App\Balance;
use App\Model\Frontend\Order;
use App\Model\Frontend\OrderItem;
use App\Model\Frontend\SoccerExpertBet;
use App\Model\Frontend\SoccerExpertRound;
use App\Model\Frontend\ScratchCard;
use App\Model\Frontend\LotteryUser;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::where('group_id', '=', 3)->get();
    }

    public function soccerExperts($id, Request $request) 
    {
        return SoccerExpertRound::whereHas('bets', function($query) use ($id) {
            $query->where('owner_id', '=', $id);
        })
        ->paginate(15);
    }

    public function scratchCards($id, Request $request) 
    {

    }

    public function lotteries($id, Request $request) 
    {
        
    }

    public function games($id, Request $request) 
    {
        return Order::where('user_id', '=', $id)->with('item');
    }

    public function orders($id, Request $request) 
    {
        $orders = Order::where('user_id', '=', $id);
        
        if($request->get('column')) {
            $orders->orderBy($request->get('column'), $request->get('direction'));
        }
        
        $orders = $orders->paginate(20);

        return response()->json($orders, 200);
    }

    public function transactions($id, Request $request) 
    {

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
        $user->nickname = $request->get('nickname');
        if($user->save()) {
            $user->nickname2 = $user->name . '_' . $user->id;
            
            Balance::create([
                'owner_id' => $user->id,
                'value' => 0.00,
            ]);

            $user->save();
            
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
        $user->nickname = $user->name . '_' . $user->id;

        if ($request->hasFile('photo')) {
            if($request->file('photo')->isValid()) {
                try {
                    $file = $request->file('photo');
                    $name = $user->id. '.' .$file->getClientOriginalExtension();
                    $request->file('photo')->move(public_path('files/profile'), $name);
                    $user->photo = request()->root() . '/files/profile/' . $name;
                } catch (Illuminate\Filesystem\FileNotFoundException $e) {

                }
            } 
        }


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
