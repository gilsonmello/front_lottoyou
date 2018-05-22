<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BalanceOrder;
use App\Services\Frontend\Paypal\PaymentService;
use Log;
use App\PaypalOrder;
use App\HistoricBalance;

class PaypalController extends Controller
{
    use PaymentService;

   
    public function payment(Request $request) 
    {
        $order = BalanceOrder::find($request->order_id);
        $order->submit = 1;
        $order->sub_total = $request->amount;
        $order->total = $request->amount;
        $order->status = 'In progress';
        if($order->save()) {
            return response()->json([
                'msg' => 'ok'
            ], 200);
        }
        return response()->json([
            'msg' => 'error'
        ], 422);
    }

    public function cancel() 
    {
        return 'cancelado';
    }

    public function feedback(Request $request) 
    {
        $data = $request->all();
        $order = BalanceOrder::find($data['invoice']);
        Log::info($request->payment_status);
        
        $order->status = $request->payment_status;
        $order->save();

        /*$paypayOrder = new PaypalOrder;
        $paypayOrder->mc_gross = $request->mc_gross;
        $paypayOrder->invoice = $request->invoice;
        $paypayOrder->protection_eligibility = $request->protection_eligibility;
        $paypayOrder->address_status = $request->address_status;
        $paypayOrder->payer_id = $request->payer_id;
        $paypayOrder->address_street = $request->address_street;
        $paypayOrder->payment_date =  $request->payment_date;
        $paypayOrder->payment_status = $request->payment_status;
        $paypayOrder->charset = $request->charset;
        $paypayOrder->address_zip = $request->address_zip;
        $paypayOrder->first_name = $request->first_name;
        $paypayOrder->mc_fee = $request->mc_fee;
        $paypayOrder->address_country_code = $request->address_country_code;
        $paypayOrder->address_name = $request->address_name;
        $paypayOrder->notify_version = $request->notify_version;
        $paypayOrder->custom = $request->custom;
        $paypayOrder->payer_status = $request->payer_status;
        $paypayOrder->business = $request->business;
        $paypayOrder->address_country = $request->address_country;
        $paypayOrder->address_city = $request->address_city;
        $paypayOrder->quantity = $request->quantity;
        $paypayOrder->verify_sign = $request->verify_sign;
        $paypayOrder->payer_email = $request->payer_email;
        $paypayOrder->txn_id = $request->txn_id;
        $paypayOrder->payment_type = $request->payment_type;
        $paypayOrder->last_name = $request->last_name;
        $paypayOrder->address_state = $request->address_state;
        $paypayOrder->receiver_email = $request->receiver_email;
        $paypayOrder->payment_fee = $request->payment_fee;
        $paypayOrder->receiver_id = $request->receiver_id;
        $paypayOrder->txn_type = $request->txn_type;
        $paypayOrder->item_name = $request->item_name;
        $paypayOrder->mc_currency = $request->mc_currency;
        $paypayOrder->item_number = $request->item_number;
        $paypayOrder->residence_country = $request->residence_country;
        $paypayOrder->test_ipn = $request->test_ipn;
        $paypayOrder->transaction_subject = $request->transaction_subject;
        $paypayOrder->payment_gross = $request->payment_gross;
        $paypayOrder->ipn_track_id = $request->ipn_track_id;
        $paypayOrder->save();

        $balance = Balance::where('owner_id', '=', $order->owner_id)->get()->first();


        $historicBalance = new HistoricBalance;
        $historicBalance->paypal_order_id = $paypayOrder->id;
        $historicBalance->type = 1;
        $historicBalance->devolution = 0;
        $historicBalance->description = 'deposit';
        $historicBalance->balance_id = $balance->id;
        $historicBalance->from = $balance->value;

        $balance->value += $request->payment_gross;

        $historicBalance->to = $balance->value;
        $historicBalance->save();

        $balance->save();*/
        
    }

    public function sessionId()
    {
        $credentials = array(
            'email' => 'lottoyou.adm@gmail.com',
            'token' => '0AA8C0B8F9F74F46B9CCB2E7C5D1FFAD'
        );

        $data = '';
        foreach ($credentials as $key => $value) {
            $data .= $key . '=' . $value . '&';
        }

        $data = rtrim($data, '&');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://ws.sandbox.pagseguro.uol.com.br/v2/sessions');
        curl_setopt($ch, CURLOPT_POST, count($credentials));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if (app()->environment() == 'production') {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        } else {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        }
        $result = curl_exec($ch);

        if (FALSE === $result)
            throw new GeneralException(curl_error($ch) . curl_errno($ch));

        $result = simplexml_load_string(curl_exec($ch));
        
        curl_close($ch);
        
        $result = (array) $result;

        //Session::put('pagseguro.sessionId', $result->id);
        return response()->json($result, 200);
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

    public function generateOrder(Request $request) {
        $balanceOrder = BalanceOrder::where('owner_id', '=', $request->owner_id)
            ->where('submit', '=', 0)
            ->orderBy('created', 'desc')
            ->get()
            ->first();

        if(is_null($balanceOrder)) {
            $balanceOrder = new BalanceOrder;
            $balanceOrder->owner_id = $request->owner_id;
            $balanceOrder->total = 0.00;
            $balanceOrder->sub_total = 0.00;
            $balanceOrder->status = 1;
            $balanceOrder->submit = 0;
            $balanceOrder->save();
            return response()->json($balanceOrder->id, 200);
        }

        return response()->json($balanceOrder->id, 200);
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
