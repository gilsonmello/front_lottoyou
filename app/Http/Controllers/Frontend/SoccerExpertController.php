<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Frontend\SoccerExpert;
use DB;

class SoccerExpertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $soccerCategories = SoccerExpert::all();

        if(!is_null($soccerCategories)) {
            return response()->json($soccerCategories, 200);
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
        $soccerCategory = SoccerExpert::where('id', '=', $id)
            ->with(['rounds', 'rounds.games'])
            ->whereHas('rounds', function($query) {
                $query->where(
                    DB::raw("concat(data_termino,' ',hora_termino)"), 
                    '>', 
                    DB::raw('DATE_SUB(NOW(), INTERVAL 1 WEEK)')
                );
            })
            ->get()
            ->first();
        if(!is_null($soccerCategory)) {
            return response()->json($soccerCategory, 200);
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
