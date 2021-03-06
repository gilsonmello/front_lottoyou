<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Lottery;
use App\LotterySweepstake;
use Illuminate\Support\Facades\DB;
use App\LotteryAward;

class LotteryController extends Controller
{
    /**
     * 
     */
    public function sweepstake($id) 
    {
        $sweepstake = LotterySweepstake::where('id', '=', $id)
            ->with([
                'result',
                'result.numbers',
                'result.numbersExtras'
            ])
            ->get()
            ->first();

        if(is_null($sweepstake)) {
            return response()->json([
                'msg' => ''
            ], 422);
        }
        return response()->json($sweepstake, 200);
    }

    public function sweepstakes($slug) 
    {
        $lottery = Lottery::where('slug', '=', $slug)->get()->first();
        $sweepstakes = LotterySweepstake::where('lot_categoria_id', '=', $lottery->id)
            ->where('active', '=', 1)
            ->where(DB::raw("concat(data_fim,' ',hora_fim)"), '>=', date('Y-m-d H:i:s'))
            ->orderBy('data_fim', 'asc')
            ->orderBy('hora_fim', 'asc')
            ->get();

        if($sweepstakes->isEmpty()) {
            return response()->json([
                'msg' => ''
            ], 422);
        }
        return response()->json($sweepstakes, 200);
    }

    public function awards($id) 
    {
        $awards = LotteryAward::where('lot_categoria_id', '=', $id)
            ->orderBy('num_acertos', 'desc')
            ->orderBy('num_acertos_extras', 'desc')
            ->orderBy('value', 'desc')
            ->get();

        if($awards->isEmpty()) {
            return response()->json([
                'message' => ''
            ], 422);
        }
        return response()->json($awards, 200);
    }

    public function find($param) 
    {
        return Lottery::where('slug', '=', $param)->orWhere('id', '=', $param)->get()->first();
    }

    /**
     * 
     */
    public function results($slug, Request $request) 
    {
        $lottery = Lottery::where('slug', '=', $slug)->get()->first();

        $sweepstakes = LotterySweepstake::where('lot_categoria_id', '=', $lottery->id)
            ->with([
                'result' => function($query) {

                },
                'result.numbers' => function($query) {

                },
                'result.numbersExtras' => function($query) {

                },
            ]);

        if($request->column && !empty($request->column)) {
            $sweepstakes->orderBy($request->column, $request->direction);
        }

        if($request->sorteio && !empty($request->sorteio)) {
            $sweepstakes->where('sorteio', 'LIKE', '%'.$request->sorteio.'%');
        }

        if($request->data_fim && !empty($request->data_fim)) {
            $request->data_fim = format_without_mask($request->data_fim, '/');
            $sweepstakes->where('data_fim', '=', $request->data_fim);
        }            

        $sweepstakes = $sweepstakes->paginate();

        return response()->json($sweepstakes, 200);
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$lotteries = Lottery::whereHas('sweepstakes', function($query) {
            $query->where('active', '=', 1)
                ->where(DB::raw("concat(data_fim,' ',hora_fim)"), '>=', date('Y-m-d H:i:s'));
        })
        ->with([
            'sweepstakes' => function($query) {
                $query->select('id', 'lot_categoria_id', 'data_fim', 'hora_fim')
                    ->where('active', '=', 1)
                    ->where(DB::raw("concat(data_fim,' ',hora_fim)"), '>=', date('Y-m-d H:i:s'))
                    ->orderBy('data_fim', 'ASC')
                    ->orderBy('hora_fim', 'ASC')
                    ->limit(1);
            }
        ])
        ->get();*/
        $lotteries = Lottery::with([
            'sweepstakes' => function($query) {
                $query->select('id', 'lot_categoria_id', 'data_fim', 'hora_fim')
                    ->where('active', '=', 1)
                    ->where(DB::raw("concat(data_fim,' ',hora_fim)"), '>=', date('Y-m-d H:i:s'))
                    ->orderBy('data_fim', 'ASC')
                    ->orderBy('hora_fim', 'ASC');
                    //->limit(1);
            }
        ])
        ->whereHas('sweepstakes', function($query) {
            $query->where('active', '=', 1)
                ->where(DB::raw("concat(data_fim,' ',hora_fim)"), '>=', date('Y-m-d H:i:s'));
        })
        ->where('active', '=', 1)
        ->get();

        if(!is_null($lotteries)) {
            return response()->json($lotteries, 200);
        }
        return response()->json([
            'message' => ''
        ], 422);
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
    public function show($slug)
    {
       $lottery = Lottery::where('slug', '=', $slug)
            ->with([
                'sweepstakes' => function($query) {
                    $query
                        ->where('active', '=', 1)
                        ->where(DB::raw("concat(data_fim,' ',hora_fim)"), '>=', date('Y-m-d H:i:s'))
                        ->orderBy('data_fim', 'asc')
                        ->orderBy('hora_fim', 'asc');
                },
                'awards' => function($query) {
                    $query
                        ->orderBy('num_acertos', 'asc')
                        ->orderBy('num_acertos_extras', 'asc');
                },
                'prices' => function($query) {
                    $query->orderBy('qtd', 'asc');
                },
            ])
            /*->whereHas('sweepstakes', function($query) {
                $query->where('active', '=', 1)
                    ->where(DB::raw("concat(data_fim,' ',hora_fim)"), '>=', date('Y-m-d H:i:s'));
            })*/
            ->get()
            ->first();

        if(!is_null($lottery)) {
            return response()->json($lottery, 200);
        }
        return response()->json(['msg' => ''], 422);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function play($slug)
    {
       $lottery = Lottery::where('slug', '=', $slug)
            ->with([
                'sweepstakes' => function($query) {
                    $query
                        ->where('active', '=', 1)
                        ->where(DB::raw("concat(data_fim,' ',hora_fim)"), '>=', date('Y-m-d H:i:s'))
                        ->orderBy('data_fim', 'asc')
                        ->orderBy('hora_fim', 'asc');
                },
                'awards' => function($query) {
                    $query
                        ->orderBy('num_acertos', 'asc')
                        ->orderBy('num_acertos_extras', 'asc');
                },
                'prices' => function($query) {
                    $query->orderBy('qtd', 'asc');
                },
            ])
            /*->whereHas('sweepstakes', function($query) {
                $query->where('active', '=', 1)
                    ->where(DB::raw("concat(data_fim,' ',hora_fim)"), '>=', date('Y-m-d H:i:s'));
            })*/
            ->get()
            ->first();

        if(!is_null($lottery)) {
            return response()->json($lottery, 200);
        }
        return response()->json(['msg' => ''], 422);
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
