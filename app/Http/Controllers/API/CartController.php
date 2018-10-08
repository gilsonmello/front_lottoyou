<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cart;
use App\CartItem;
use App\Order;
use App\OrderItem;
use App\SoccerExpertRound;
use App\LotterySweepstake;
use App\ScratchCard;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Repositories\API\Cart\CartContract;

class CartController extends Controller
{
    public function __construct(CartContract $repository) 
    {
        $this->repository = $repository;
        if(isset(request()->header()['authorization'])) {
            $this->middleware('auth:api');
        }
    }

    private function scratchCardValidate($theme_id, $quantity)
    {
        $scratchCard = ScratchCard::select([
            DB::raw('count(temas_raspadinha_id) as total_tickets_available')
        ])->where('ativo', '=', 0)
            ->where('temas_raspadinha_id', '=', $theme_id)
            ->groupBy([
                'temas_raspadinha_id',
            ])
            ->get()
            ->first();

        if($scratchCard) {
            return $scratchCard->total_tickets_available > $quantity ? true : false;
        }

        return false;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function validateLotteryFastPayment(Request $request)
    {
        $valid = [
            'valid' => true,
            'msg' => 'ok'
        ];

        $sweepstake = LotterySweepstake::where('id', '=', $request['sweepstake']['id'])
            ->where('active', '=', 1)
            ->where(
                DB::raw("concat(data_fim,' ',hora_fim)"),
                '>=',
                date('Y-m-d H:i:s')
            )
            ->get()
            ->first();

        if(is_null($sweepstake)) {
            $valid = [
                'valid' => false,
                'msg' => 'O sorteio '.$request['sweepstake']['sorteio'].' encontra-se indisponível.<br>Remova-o do carrinho para continuar'
            ];
            return response()->json($valid, 422);
        }

        return response()->json($valid, 200);
    }


    /**
     * @param Request $request
     * @return array
     */
    public function validateSoccerExpertFastPayment(Request $request)
    {
        $round = SoccerExpertRound::where('id', '=', $request['tickets'][0]['id'])
            ->where('active', '=', 1)
            ->where(
                DB::raw("concat(data_termino,' ',hora_termino)"),
                '>=',
                date('Y-m-d H:i:s')
            )
            ->get()
            ->first();

        $valid = [
            'valid' => true,
            'msg' => 'ok'
        ];

        if(is_null($round)) {
            $valid = [
                'valid' => false,
                'msg' => 'O ticket '.$request['tickets'][0]['nome'].' encontra-se indisponível.<br>Remova-o do carrinho para continuar'
            ];
            return response()->json($valid, 422);
        }
        return response()->json($valid, 200);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function validateCartoleandoFastPayment(Request $request)
    {
        $user = $request->user();
        $data = $request->all();

        $package = \App\LeaguePackage::find($data['package']['id']);
        
        //Se o usuário estiver logado, evitar que o pacote apareça para ele novamente            
        $itemsIDS = \App\OrderItem::where('user_id', '=', $user->id)
            ->select([
                'lea_package_id'
            ])
            ->where('lea_package_id', '=', $package->id)
            ->where('type', '=', 'cartoleando')
            ->get();
            
        if(!$itemsIDS->isEmpty()) {
            $valid =  [
                'valid' => false, 
                'msg' => 'Você já possui o pacote '.$package->name.'.<br>Só é permitido uma compra.'
            ];
            return response()->json($valid, 422);
        }
         
        $valid =  [
            'valid' => true, 
            'msg' => 'ok'
        ];
        return response()->json($valid, 200);
    }

    private function soccerExpertValidate($data) 
    {
        foreach ($data as $key => $ticket) {
            
            $round = SoccerExpertRound::where('id', '=', $ticket['id'])
                ->where('active', '=', 1)
                ->where(
                    DB::raw("concat(data_termino,' ',hora_termino)"), 
                    '>=', 
                    date('Y-m-d H:i:s')
                )
                ->get();

            $valid = [
                'valid' => true, 
                'msg' => 'ok'
            ];

            if($round->isEmpty()) {
                $valid = [
                    'valid' => false, 
                    'msg' => 'O ticket '.$ticket['nome'].' encontra-se indisponível.<br>Remova-o do carrinho para continuar'
                ];
                break;
            }
        }

        return $valid;        
    }

    private function cartoleandoValidate($data, $request) 
    {
        $user = $request->user();  

        $package = \App\LeaguePackage::find($data['package']['id']);

        //Se o usuário estiver logado, evitar que o pacote apareça para ele novamente            
        $itemsIDS = \App\OrderItem::where('user_id', '=', $user->id)
            ->select([
                'lea_package_id'
            ])
            ->where('lea_package_id', '=', $package->id)
            ->where('type', '=', 'cartoleando')
            ->get();
            
        if(!$itemsIDS->isEmpty()) {
            return [
                'valid' => false, 
                'msg' => 'Você já possui o pacote '.$package->name.'.<br>Remova-o do carrinho para continuar'
            ];
        }
         
        return [
            'valid' => true, 
            'msg' => 'ok'
        ];
    }

    private function lotteryValidate($data) 
    {
        $valid = [
            'valid' => true, 
            'msg' => 'ok'
        ];

        $sweepstake = LotterySweepstake::where('id', '=', $data['id'])
            ->where('active', '=', 1)
            ->where(
                DB::raw("concat(data_fim,' ',hora_fim)"), 
                '>=', 
                date('Y-m-d H:i:s')
            )
            ->get();

        if($sweepstake->isEmpty()) {
            $valid = [
                'valid' => false, 
                'msg' => 'O sorteio '.$data['sorteio'].' encontra-se indisponível.<br>Remova-o do carrinho para continuar'
            ];
        }

        return $valid;                
    }

    public function validatePurchase(Request $request) 
    {
        $data = $request->all();

        $valid = [
            'valid' => true, 
            'msg' => 'ok'
        ];

        foreach($data['items'] as $key => $value) {
            if($value['type'] == 'scratch_card') {
                $scratchCard = $value['scratch_card']['scratch_card'];
                $valid['valid'] = $this->scratchCardValidate(
                    $scratchCard['id'], 
                    $scratchCard['discount_tables']['quantity']
                );

                if(!$valid['valid']) {
                    $valid['msg'] = 'A raspadinha '. $scratchCard['nome'] . ' encontra-se indisponível.';
                    return response()->json($valid, 422);
                }

            } else if($value['type'] == 'soccer_expert') {
                $soccerExpert = $value['soccer_expert']['tickets'];
                
                $valid = $this->soccerExpertValidate($soccerExpert);

                if(!$valid['valid']) {
                    return response()->json($valid, 422);
                }
                
            } else if($value['type'] == 'lottery') {
                $lottery = $value['lottery']['sweepstake'];
                $valid = $this->lotteryValidate($lottery);

                if(!$valid['valid']) {
                    return response()->json($valid, 422);
                }
            } else if($value['type'] == 'cartoleando') {
                $cartoleando = $value['cartoleando'];
                $valid = $this->cartoleandoValidate($cartoleando, $request);

                if(!$valid['valid']) {
                    return response()->json($valid, 422);
                }
            }
        }

        return response()->json($valid, 200);
    }

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
                ->with([
                    'items' => function($query) {
                        $query->orderBy('created_at', 'DESC');
                    }
                ])
                ->orderBy('created_at', 'DESC')
                ->get()
                ->first();
        } else {
            $cart = Cart::where('visitor', '=', $request->ip())
                ->where('finished', '=', 0)
                ->with([
                    'items' => function($query) {
                        $query->orderBy('created_at', 'DESC');
                    }
                ])
                ->orderBy('created_at', 'DESC')
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
    public function addCartoleando(Request $request)
    { 
        $auth = $request->get('auth');
        $user = $request->user() == null ? $auth : $request->user();
        $user_id = gettype($user) === 'array' ? $user['id'] : $user->id;
        $user = User::find($user_id);
        $team = $user->team;
        $purchase = $request->purchase;
        $purchase['team'] = $team->toArray();
        $purchase['name'] = $team->name;
        $purchase['slug'] = $team->slug;
        $purchase['email'] = $team->email;
        $purchase['cartoleiro'] = $team->cartoleiro;
        $request->merge([
            'purchase' => $purchase
        ]);
        //$request->get('purchase')['name'] = 'sdfdsf';
        /* $request->purchase['name'] = $team->name;
        $request->purchase['slug'] = $team->slug;
        $request->purchase['email'] = $team->email; */
        $this->insertOrRefreshCart($request, 'cartoleando');
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

    private function insertOrRefreshCart($request, $type) 
    {
        $data = $request->get('purchase');
        $auth = $request->get('auth');
        $hash = $request->get('hash');

        $user = $request->user() == null ? $auth : $request->user();

        $user_id = gettype($user) === 'array' ? $user['id'] : $user->id;

        if($user != null) {
            $cart = Cart::where('user_id', '=', $user_id)
                ->where('finished', '=', 0)
                ->get()
                ->first();

            if(is_null($cart)) {
                $cart = new Cart;
                $cart->user_id = $user_id != null ? $user_id : null;
                $cart->finished = 0;
                $cart->visitor = $request->ip();

                $cart->save();

                $cartItem = new CartItem;

                $cartItem->cart_id = $cart->id;
                $cartItem->hash = $hash;
                $cartItem->type = $type;
                $cartItem->data = $data != null ? json_encode($data) : null;

                $cartItem->save();
            } else {
                
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
        } else {

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
            } else {
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
    public function completeFastPaymentLottery(Request $request)
    {
        //Iniciando a transação
        DB::beginTransaction();

        //Caso ocorra algum erro de SQL, é feito o rollback
        try {
            if($this->repository->saveOrderFastPaymentLottery($request)) {
                DB::commit();
                return response()->json(['message' => 'ok'], 200);
            }
            DB::rollBack();
            return response()->json(['message' => 'error'], 422);
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
        } catch (\PDOException $e) {
            DB::rollBack();
        }
        return response()->json(['message' => 'error'], 422);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function completeFastPaymentSoccerExpert(Request $request)
    {
        //Iniciando a transação
        DB::beginTransaction();

        //Caso ocorra algum erro de SQL, é feito o rollback
        try {
            if($this->repository->saveOrderFastPaymentSoccerExpert($request)) {
                DB::commit();
                return response()->json(['message' => 'ok'], 200);
            }
            DB::rollBack();
            return response()->json(['message' => 'error'], 422);
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
        } catch (\PDOException $e) {
            DB::rollBack();
        }

        return response()->json(['message' => 'error'], 422);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function completeFastPaymentCartoleando(Request $request)
    {
        //Iniciando a transação
        DB::beginTransaction();
        //Caso ocorra algum erro de SQL, é feito o rollback
        try {
            if($this->repository->saveOrderFastPaymentCartoleando($request)) {
                DB::commit();
                return response()->json(['message' => 'ok'], 200);
            }
            DB::rollBack();
            return response()->json(['message' => 'error'], 422);
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
        } catch (\PDOException $e) {
            DB::rollBack();
        }

        return response()->json(['message' => 'error'], 422);
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function completePurchase(Request $request)
    {
        //Iniciando a transação
        DB::beginTransaction();

        //Caso ocorra algum erro de SQL, é feito o rollback
        try {
            if($this->repository->saveOrder($request)) {
                DB::commit();
                return response()->json(['message' => 'ok'], 200);
            }
            DB::rollBack();
            return response()->json(['message' => 'error'], 422);
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
        } catch (\PDOException $e) {
            DB::rollBack();
        }      
        return response()->json(['message' => 'error'], 422);
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

        $cartId = $cartItem->cart_id;
            
           
        $cartItem->delete();

        
        $cartItem = CartItem::where('cart_id', '=', $cartId)->get();
        
        if($cartItem->isEmpty()) {

            $cart = Cart::find($cartId);

            $cart->delete();
        }

    }
}
