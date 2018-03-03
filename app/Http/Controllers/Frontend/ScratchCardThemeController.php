<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Frontend\ScratchCardTheme;
use App\Model\Frontend\ScratchCardLot;
use App\Model\Frontend\ScratchCardDemo;

class ScratchCardThemeController extends Controller
{
    
    public function jackpotAvailable($id = null){
        $jackpotAvailable = ScratchCardLot::with('theme')
            ->select('id', 'temas_raspadinha_id')
            ->where('temas_raspadinha_id', '=', $id)
            ->get()
            ->first();
        if(!is_null($jackpotAvailable)) {
            return response()->json($jackpotAvailable, 200);
        }
        return response()->json(['msg' => trans('strings.not_found_jacktpot_table')], 422);
    }

    public function demo($id = null) {
        $demo = ScratchCardDemo::with('theme')
            ->where('temas_raspadinha_id', '=', $id)
            ->orderByRaw('RAND()')
            ->get()
            ->first();
        if(!is_null($demo)) {
           return response()->json($demo, 200);
        }
        return response()->json(['msg' => trans('strings.not_found_demo')], 422);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ScratchCardTheme::whereHas('lots', function($query) {
            $query->where('active', '=', 1);
        })->get();
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
