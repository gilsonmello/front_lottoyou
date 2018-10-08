<?php

namespace App\Repositories\API\Cart;

use App\PasswordReset;
use Illuminate\Http\Request;
use App\Order;
use App\OrderItem;
use App\Cart;

class CartRepository implements CartContract
{
    public function __construct() 
	{

    }

    public function saveOrder($request) 
    {
        $order = new Order;

        $order->user_id = $request->user()->id;
        $order->total = $request->get('total');
        $order->sub_total = $request->get('sub_total');
        $order->number_items = $request->get('quantity');
        $order->status = 1;
        
        $coupon = $request->get('coupon') != null ? $request->get('coupon') : null;
        
        $order->coupon_id = $coupon != null ? $coupon['id'] : null;

        $items = $request->get('items');

        if($order->save()) {
            foreach($items as $key => $value) {
                $orderItem = new OrderItem;
                $orderItem->order_id = $order->id;
                $orderItem->type = $value['type'];
                $orderItem->context_message = 'buy';
                $data = null;
                if($value['type'] == 'lottery') {
                    $data = json_encode($value['lottery']);
                    $orderItem->data = $data;
                    $orderItem->amount = $value['lottery']['value'];
                    $orderItem->context_id = $value['lottery']['id'];
                    $orderItem->hash = $value['lottery']['hash'];
                    $orderItem->quantity = count($value['lottery']['tickets']);
                    /*$order->lotteries()->attach($value['lottery']['id'], [
                        'data' => $data
                    ]);*/
                } else if($value['type'] == 'soccer_expert') {
                    $data = json_encode($value['soccer_expert']);
                    $orderItem->amount = $value['soccer_expert']['total'];
                    $orderItem->data = $data;
                    $orderItem->hash = $value['soccer_expert']['hash'];
                    $orderItem->quantity = count($value['soccer_expert']['tickets']);
                    $orderItem->context_id = $value['soccer_expert']['soccer_expert']['id'];
                    /*$order->soccerExperts()->attach($value['soccer_expert']['soccer_expert']['id'], [
                        'data' => $data
                    ]);*/
                } else if($value['type'] == 'scratch_card') {
                    $data = json_encode($value['scratch_card']);
                    $orderItem->data = $data;
                    $orderItem->quantity = $value['scratch_card']['scratch_card']['discount_tables']['quantity'];
                    $orderItem->amount = $value['scratch_card']['total'];
                    $orderItem->hash = $value['scratch_card']['hash'];
                    $orderItem->context_id = $value['scratch_card']['scratch_card']['id'];
                    /*$order->scratchCards()->attach($value['scratch_card']['scratch_card']['id'], [
                        'data' => $data
                    ]);*/
                } else if($value['type'] == 'cartoleando') {
                    $data = json_encode($value['cartoleando']);
                    foreach($value['cartoleando']['package']['leagues'] as $league) {
                        $orderItem = new \App\OrderItem;
                        $orderItem->order_id = $order->id;
                        $orderItem->type = $value['type'];
                        $orderItem->user_id = $request->user()->id;
                        $orderItem->data = $data;
                        $orderItem->quantity = 1;
                        $orderItem->context_id = $league['id'];
                        $orderItem->amount = $value['cartoleando']['package']['value'];
                        $orderItem->hash = $value['cartoleando']['hash'];
                        $orderItem->save();
                    }
                    continue;                    
                }

                $orderItem->user_id = $request->user()->id;
                $orderItem->save();
            }

            $cart = Cart::where('user_id', '=', $request->get('user_id'))
                ->where('finished', '=', 0)
                ->get()
                ->first();
                
            if($cart) {
                $cart->finished = 1;
                $cart->save();   
            }

            $cart = Cart::where('visitor', '=', $request->ip())
                ->where('finished', '=', 0)
                ->get()
                ->first();

            if($cart) {
                $cart->finished = 1;
                $cart->save();   
            }   
            
            return true;
        }   
        return false;
    }

    public function saveOrderFastPaymentLottery($request)
    {
        $order = new Order;
        $order->user_id = $request->user()->id;
        $order->total = $request['purchase']['total'];
        $order->sub_total = $request['purchase']['total'];
        $order->number_items = 1;
        $order->status = 1;

        $coupon = $request->get('coupon') != null ? $request->get('coupon') : null;

        $order->coupon_id = $coupon != null ? $coupon['id'] : null;

        if($order->save()) {
            $orderItem = new OrderItem;
            $orderItem->order_id = $order->id;
            $orderItem->type = 'lottery';
            $data = json_encode($request['purchase']);
            $orderItem->data = $data;
            $orderItem->hash = $request['purchase']['hash'];
            $orderItem->context_id = $request['purchase']['lottery']['id'];
            $orderItem->amount = $request['purchase']['total'];
            $orderItem->quantity = count($request['purchase']['tickets']);
            $orderItem->save();
            return true;
        }
        return false;
    }

    public function saveOrderFastPaymentSoccerExpert($request)
    {
        $order = new Order;
        $order->user_id = $request->user()->id;
        $order->total = $request['purchase']['total'];
        $order->sub_total = $request['purchase']['total'];
        $order->number_items = 1;
        $order->status = 1;

        $coupon = $request->get('coupon') != null ? $request->get('coupon') : null;

        $order->coupon_id = $coupon != null ? $coupon['id'] : null;

        if($order->save()) {
            $orderItem = new OrderItem;
            $orderItem->order_id = $order->id;
            $orderItem->type = 'soccer_expert';
            $data = json_encode($request['purchase']);
            $orderItem->data = $data;
            $orderItem->context_id = $request['purchase']['soccer_expert']['id'];
            $orderItem->hash = $request['purchase']['hash'];
            $orderItem->user_id = $order->user_id;
            $orderItem->amount = $request['purchase']['total'];
            $orderItem->quantity = count($request['purchase']['tickets']);
            $orderItem->save();
            return true;
        }
        return false;
    }

    public function saveOrderFastPaymentCartoleando($request)
    {
        $order = new Order;
        $order->user_id = $request->user()->id;
        $order->total = $request['purchase']['total'];
        $order->sub_total = $request['purchase']['total'];
        $order->number_items = count($request['purchase']['package']['leagues']);
        $order->status = 1;
        
        $coupon = $request->get('coupon') != null ? $request->get('coupon') : null;

        $order->coupon_id = $coupon != null ? $coupon['id'] : null;

        if($order->save()) {
            $data = json_encode($request['purchase']);
            $package = $request['purchase']['package'];
            $hash = $request['hash'];
            $leagues = $request['purchase']['package']['leagues'];
            foreach($leagues as $league) {
                $orderItem = new \App\OrderItem;
                $orderItem->order_id = $order->id;
                $orderItem->type = 'cartoleando';
                $orderItem->user_id = $request->user()->id;
                $orderItem->data = $data;
                $orderItem->quantity = 1;
                $orderItem->context_id = $league['id'];
                $orderItem->amount = $package['value'];
                $orderItem->hash = $hash;
                $orderItem->save();
            }
            return true;
        }
        return false;
    }
}