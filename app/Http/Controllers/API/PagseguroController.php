<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BalanceOrder;
use App\Services\Frontend\Pagseguro\PaymentService;
use Illuminate\Support\Facades\Log;

class PagseguroController extends Controller
{
    use PaymentService;

    public function back(Request $request) 
    {
    }

    public function feedback(Request $request) 
    {
        Log::info($_POST);
        $code = $_POST['notificationCode'];

        $code .= '?email='.env('PAGSEGURO_EMAIL').'&token='.env('PAGSEGURO_TOKEN');

        ////////////// To tests //////////////
        //$code = '7F7AA96F474A474A222664BC9F8EFA8680C4';

        $request = [
            'url' => 'https://ws.pagseguro.uol.com.br/v2/transactions/notifications/'.$code,
            'params' => [
                'email' => env('PAGSEGURO_EMAIL'),
                'token' => env('PAGSEGURO_TOKEN')
            ]
        ];

        //$request = Request::create($request['url'], 'get', $request['params']);
        //$response = Route::dispatch( $request );

        //Log::inf($response);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $request['url']);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [ 'application/x-www-form-urlencoded; charset=ISO-8859-1']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        if (app()->environment() == 'production') {
            curl_setopt($ch, CURLUSESSL_TRY, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        } else {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        }

        $result = curl_exec($ch);

        curl_close($ch);
        
        //$response = \HttpClient::get($request);
        //$dataXml = $response->xml();

        $dataXml = simplexml_load_string($result);

        $this->updateFromPagseguroFeedback($dataXml);
    }

    public function sessionId()
    {
        $credentials = array(
            'email' => env('PAGSEGURO_EMAIL'),
            'token' => env('PAGSEGURO_TOKEN')
        );

        $data = '';
        foreach ($credentials as $key => $value) {
            $data .= $key . '=' . $value . '&';
        }

        $data = rtrim($data, '&');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://ws.pagseguro.uol.com.br/v2/sessions');
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
        // Get cURL resource
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'https://api.hgbrasil.com/finance?format=json&key=d58b8e61',
        ));
        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        // Close request to clear up some resources
        curl_close($curl);
        $resp = json_decode($resp);

        $order = BalanceOrder::find($request->order_id);
        $order->submit = 1;
        $order->sub_total = $request->amount;
        $order->total = $request->amount;
        $order->status = 'In progress';
        $order->status_pagseguro = 0;
        $order->quotation_dolar = $resp->results->currencies->USD->buy;
        if($order->save()) {
            return response()->json([
                'msg' => 'ok'
            ], 200);
        }
        return response()->json([
            'msg' => 'error'
        ], 422);
    }

    /*public function payment(Request $request)
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
    }*/

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
            $balanceOrder->status = 'In progress';
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
