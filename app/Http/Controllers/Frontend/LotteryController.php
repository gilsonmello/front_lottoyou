<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Lottery;
use App\LotterySweepstake;
use Illuminate\Support\Facades\DB;

class LotteryController extends Controller
{

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

    public function results($slug, Request $request) 
    {
        $lottery = Lottery::where('slug', '=', $slug)->get()->first();
        $sweepstakes = LotterySweepstake::where('lot_categoria_id', '=', $lottery->id)
            ->paginate();

        return view('frontend.lotteries.results')
            ->with('lottery', $lottery)
            ->with('sweepstakes', $sweepstakes);        
    }

    /**
     * 
     */
    public function play($slug, Request $request) 
    {
        $lottery = Lottery::whereHas('sweepstakes', function($query) {
            $query->where('active', '=', 1)
                ->where(DB::raw("concat(data_fim,' ',hora_fim)"), '>=', date('Y-m-d H:i:s'));
        })->where('slug', '=', $slug)
            ->get()
            ->first();

        return view('frontend.lotteries.play')
            ->with('lottery', $lottery);
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
        ->get();

        return view('frontend.lotteries.index')
            ->with('lotteries', $lotteries);
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
