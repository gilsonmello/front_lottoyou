<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BalanceOrder;
use App\Services\Frontend\Paypal\PaymentService;
use Illuminate\Support\Facades\Log;
use App\PaypalOrder;
use App\HistoricBalance;
use App\Balance;
use Carbon\Carbon;

class PaypalController extends Controller
{
    use PaymentService;

   
    public function payment(Request $request) 
    {
        $order = BalanceOrder::find($request->order_id);
        $order->submit = 1;
        $order->sub_total = $request->amount;
        $order->total = $request->amount;
        $order->status_paypal = 'In progress';
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
        $order = BalanceOrder::find($request->invoice);
        
        $paypayOrder = new PaypalOrder;
        $paypayOrder->balance_order_id = $order->id;
        $paypayOrder->mc_gross = $request->mc_gross;
        $paypayOrder->invoice = $request->invoice;
        $paypayOrder->protection_eligibility = $request->protection_eligibility;
        $paypayOrder->address_status = $request->address_status;
        $paypayOrder->payer_id = $request->payer_id;
        $paypayOrder->address_street = $request->address_street;
        $paypayOrder->payment_date = $request->payment_date;
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


        if ($order->date_confirmation == null) {
            $order->date_confirmation = Carbon::now();
        }

        if(($request->payment_status == 'Canceled_Reversal' ||
            $request->payment_status == 'Denied' ||
            $request->payment_status == 'Expired' ||
            $request->payment_status == 'Reversed' ||
            $request->payment_status == 'Voided')
            && ($order->status_paypal != 'Canceled_Reversal'
                && $order->status_paypal != 'Denied'
                && $order->status_paypal != 'Expired'
                && $order->status_paypal != 'Reversed'
                && $order->status_paypal != 'Voided')) {
            $balance = Balance::where('owner_id', '=', $order->owner_id)->get()->first();

            $historicBalance = new HistoricBalance;
            $historicBalance->paypal_order_id = $paypayOrder->id;
            $historicBalance->type = 0;
            $historicBalance->devolution = 1;
            $historicBalance->description = 'Reembolso no valor de R$'. $request->payment_gross * -1;
            $historicBalance->balance_id = $balance->id;
            $historicBalance->from = $balance->value;
            $historicBalance->owner_id = $balance->owner_id;
            $historicBalance->amount = $request->payment_gross * -1;
            $historicBalance->modality = 'devolution';
            $historicBalance->context = 'paypal_orders';
            $historicBalance->context_message = 'devolution.paypal';
            $historicBalance->system = 0;
            $historicBalance->context_id = $paypayOrder->id;

            $balance->value -= $request->payment_gross;
            $balance->value = $balance->value < 0 ? 0 : $balance->value;

            $historicBalance->to = $balance->value;
            $historicBalance->save();

            $balance->save();

        }

        if($request->payment_status == 'Completed' && $order->status_paypal != 'Completed') {
            $balance = Balance::where('owner_id', '=', $order->owner_id)->get()->first();

            $historicBalance = new HistoricBalance;
            $historicBalance->paypal_order_id = $paypayOrder->id;
            $historicBalance->type = 1;
            $historicBalance->devolution = 0;
            $historicBalance->description = 'Valor de R$' . $request->payment_gross .' inserido na sua conta';
            $historicBalance->balance_id = $balance->id;
            $historicBalance->from = $balance->value;
            $historicBalance->owner_id = $balance->owner_id;
            $historicBalance->amount = $request->payment_gross;
            $historicBalance->modality = 'deposit';
            $historicBalance->context = 'paypal_orders';
            $historicBalance->context_message = 'deposit.paypal';
            $historicBalance->context_id = $paypayOrder->id;
            $historicBalance->system = 1;

            $balance->value += $request->payment_gross;

            $historicBalance->to = $balance->value;
            $historicBalance->save();

            $balance->save();
        }

        $order->status_paypal = $request->payment_status;
        $order->status = $request->payment_status;
        $order->save();
        
    }

    public function sessionId()
    {

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
            $balanceOrder->status_paypal = 'In progress';
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
