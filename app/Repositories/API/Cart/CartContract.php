<?php namespace App\Repositories\API\Cart;

use Illuminate\Http\Request;

interface CartContract
{
    public function saveOrder($request);
    
    public function saveOrderFastPaymentLottery($request);

    public function saveOrderFastPaymentSoccerExpert($request);

    public function saveOrderFastPaymentCartoleando($request);
}