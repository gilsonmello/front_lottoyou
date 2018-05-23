<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\HistoricBalance;

class HistoricBalanceController extends Controller
{
    public function ofTheUser($owner_id, Request $request) 
    {
        $historicBalances = HistoricBalance::where('owner_id', '=', $owner_id);
        if($request->column && !empty($request->column)) {
            $historicBalances->orderBy($request->column, $request->direction);
        }

        $historicBalances->with([
            'pagseguro' => function($queyr) {

            },
            'paypal' => function($queyr) {

            },
            'orderItem' => function($query) {

            },
            'orderItem.soccerExpert' => function($query) {

            },
            'orderItem.scratchCard' => function($query) {

            },
            'orderItem.lottery' => function($query) {

            },
            'scratchCard' => function($query) {

            },
            'scratchCard.theme' => function($query) {

            },
            'balance' => function($query) {

            },
            'soccerExpertBet' => function($query) {

            },
            'soccerExpertBet.round' => function($query) {

            },
            'soccerExpertBet.group' => function($query) {

            },
            'lotteryBet' => function($query) {

            },
            'lotteryBet.sweepstake' => function($query) {

            },
            'devolution' => function($query) {

            },
        ]);
        
        return response()->json($historicBalances->paginate(), 200);
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
