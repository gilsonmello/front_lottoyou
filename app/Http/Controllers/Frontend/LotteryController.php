<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Frontend\Lottery;
use App\Model\Frontend\LotterySweepstake;
use DB;

class LotteryController extends Controller
{
    public function sweepstakes($id) 
    {
        $sweepstakes = LotterySweepstake::where('lot_categoria_id', '=', $id)
            ->where('active', '=', 1)
            ->where(DB::raw("concat(data_fim,' ',hora_fim)"), '>=', date('Y-m-d H:i:s'))
            ->get();

        if($sweepstakes->isEmpty()) {
            return response()->json([
                'msg' => ''
            ], 422);
        }
        return response()->json($sweepstakes, 200);
    }

    public function find($id) 
    {
        return Lottery::find($id);
    }

    public function results($id, Request $request) 
    {

        $sweepstakes = LotterySweepstake::where('lot_categoria_id', '=', $id)
            ->with([
                'results' => function($query) {

                },
                'results.numbers' => function($query) {

                },
                'results.numbersExtras' => function($query) {

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
        $lotteries = Lottery::whereHas('sweepstakes', function($query) {
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
        ->get();

        if(!is_null($lotteries)) {
            return response()->json($lotteries, 200);
        }
        return response()->json([
            'msg' => ''
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
    public function show($id)
    {
       $lottery = Lottery::where('id', '=', $id)
            ->with([
                'sweepstakes' => function($query) {
                    $query->where('active', '=', 1)
                        ->where(DB::raw("concat(data_fim,' ',hora_fim)"), '>=', date('Y-m-d H:i:s'));
                }
            ])
            ->whereHas('sweepstakes', function($query) {
                $query->where('active', '=', 1)
                    ->where(DB::raw("concat(data_fim,' ',hora_fim)"), '>=', date('Y-m-d H:i:s'));
            })
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
