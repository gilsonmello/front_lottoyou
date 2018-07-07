<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ScratchCard;

class ScratchCardController extends Controller
{

    public function jackpotAvailable($theme_id = null){
        return ScratchCard::selectRaw('count(*) as quantity, premio as jackpot, lote')
            ->where('temas_raspadinha_id', '=', $theme_id)
            ->where('ativo', '=', 3)
            ->groupBy(['jackpot', 'lote'])
            ->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return ScratchCard[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return ScratchCard::all();
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
