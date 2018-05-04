<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Frontend\Lottery;
use App\Model\Frontend\LotterySweepstake;
use DB;

class LotteryController extends Controller
{
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
                    ->orderBy('data_fim', 'ASC')
                    ->orderBy('hora_fim', 'ASC')
                    ->limit(1);
            }
        ])
        ->get();

        if(!is_null($lotteries)) {
            return response()->json($lotteries, 200);
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
            ->with('sweepstakes')
            ->whereHas('sweepstakes', function($query) {
                $query->where('active', '=', 1)
                    ->where(DB::raw("concat(data_fim,' ',hora_fim)"), '>', date('Y-m-d H:i:s'));
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
