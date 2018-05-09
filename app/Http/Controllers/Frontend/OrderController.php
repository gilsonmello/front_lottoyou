<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Frontend\Order;
use App\Model\Frontend\OrderItem;
use Gate;
use App\User;
use Auth;

class OrderController extends Controller
{
    public function items($id, Request $request) 
    {
        $user_id = $request->get('user_id');

        $order = Order::find($id);      

        $user = User::find($user_id); 

        Gate::forUser($user)->allows('frontend.orders.show', $order);

        //$this->authorize('frontend.orders.show', [$user, $order]);


        $items = OrderItem::where('order_id', '=', $id);
        
        if($request->get('column')) {
            $items->orderBy($request->get('column'), $request->get('direction'));
        }
        
        $items = $items->with([
            'soccerExpert',
            'scratchCard',
            'lottery'
        ])->paginate(15);

        return response()->json($items, 200);
    }

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
    public function update(Request $request, $id)
    {
        //
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
