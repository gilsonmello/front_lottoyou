<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Frontend\Cart;
use App\Model\Frontend\CartItem;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cart = null;

        if($request->get('id')) {
            $cart = Cart::where('user_id', '=', $request->get('id'))
                ->where('finished', '=', 0)
                ->with('items')
                ->get()
                ->first();
        } else {
            $cart = Cart::where('visitor', '=', $request->ip())
                ->where('finished', '=', 0)
                ->with('items')
                ->get()
                ->first();
        }

        if(!is_null($cart)) {
            return response()->json($cart, 200);
        }

        return response()->json(['msg' => ''], 422);
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
    public function addLottery(Request $request)
    { 
        $this->insertOrRefreshCart($request, 'lottery');
        return response()->json(['msg' => 'ok'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addSoccerExpert(Request $request)
    { 
        $this->insertOrRefreshCart($request, 'soccer_expert');
        return response()->json(['msg' => 'ok'], 200);
    }

    private function insertOrRefreshCart($request, $type) {
        $data = $request->get('purchase');
        $auth = $request->get('auth');
        $hash = $request->get('hash');

        $user = $auth;

        if($user != null) {
            $cart = Cart::where('user_id', '=', $user['id'])
                ->where('finished', '=', 0)
                ->get()
                ->first();


            if(is_null($cart)) {
                $cart = new Cart;
                $cart->user_id = $user['id'] != null ? $user['id'] : null;
                $cart->finished = 0;
                $cart->visitor = $request->ip();

                $cart->save();

                $cartItem = new CartItem;

                $cartItem->cart_id = $cart->id;
                $cartItem->hash = $hash;
                $cartItem->type = $type;
                $cartItem->data = $data != null ? json_encode($data) : null;

                $cartItem->save();
            }else {
                
                $cartItem = CartItem::where('cart_id', '=', $cart->id)
                    ->where('hash', '=', $hash)
                    ->get()
                    ->first();

                
                if(!is_null($cartItem)) {
                    $cartItem->data = $data != null ? json_encode($data) : null;
                    $cartItem->save();
                } else {
                    $cartItem = new CartItem;
                    $cartItem->cart_id = $cart->id;
                    $cartItem->type = $type;
                    $cartItem->hash = $hash;
                    $cartItem->data = $data != null ? json_encode($data) : null;
                    $cartItem->save();
                }
            }
        }else {

            $cart = Cart::where('visitor', '=', $request->ip())
                ->where('finished', '=', 0)
                ->get()
                ->first();

            if(is_null($cart)) {
                $cart = new Cart;
                $cart->user_id = null;
                                
                $cart->finished = 0;
                $cart->visitor = $request->ip();

                $cart->save();

                $cartItem = new CartItem;

                $cartItem->cart_id = $cart->id;
                $cartItem->hash = $hash;
                
                $cartItem->type = $type;
                
                $cartItem->data = $data != null ? json_encode($data) : null;

                $cartItem->save();
            }else {
                $cartItem = CartItem::where('cart_id', '=', $cart->id)
                    ->where('hash', '=', $hash)
                    ->get()
                    ->first();

                if(!is_null($cartItem)) {
                    $cartItem->data = $data != null ? json_encode($data) : null;
                    $cartItem->save();
                } else {
                    $cartItem = new CartItem;
                    $cartItem->cart_id = $cart->id;
                    $cartItem->type = $type;
                    $cartItem->hash = $hash;
                    $cartItem->data = $data != null ? json_encode($data) : null;
                    $cartItem->save();
                }
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addScratchCard(Request $request)
    {   
        $this->insertOrRefreshCart($request, 'scratch_card');
        return response()->json(['msg' => 'ok'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cart = new Cart;
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
    public function destroy($hash)
    {
        $cartItem = CartItem::where('hash', '=', $hash)->get()->first();

        $cartItem->delete();
    }
}
