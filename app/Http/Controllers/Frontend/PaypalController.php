<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BalanceOrder;
use App\Services\Frontend\Paypal\PaymentService;

class PaypalController extends Controller
{
    use PaymentService;

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

    public function payment(Request $request)
    {
        $items = $this->getCheckout($request->all());
       
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [ 'application/x-www-form-urlencoded; charset=ISO-8859-1']);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($items));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        if (app()->environment() == 'production') {
            curl_setopt($ch, CURLUSESSL_TRY, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        } else {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        }

        $result = curl_exec($ch);
        return response()->json($result, 200);
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
