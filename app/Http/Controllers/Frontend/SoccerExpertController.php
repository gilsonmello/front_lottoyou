<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Frontend\SoccerExpert;
use App\Model\Frontend\SoccerExpertRound;
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
        /*$soccerCategories = SoccerExpert::whereHas('rounds', function($query) {
            $query->where(
                DB::raw("concat(data_termino,' ',hora_termino)"), 
                '>', 
                DB::raw('ADDDATE(NOW(), INTERVAL 7 DAY)')
            );
        });*/
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
        $soccerExpert = SoccerExpert::where('id', '=', $id)->select(
            'id', 
            'nome',
            'imagem_capa',
            'active',
            'ordem',
            'novo',
            'created',
            'modified'
        )->get()->first();


        $roundsWeek = SoccerExpertRound::where('soc_categoria_id', '=', $id)
            ->with(['games'])
            ->where(
                DB::raw("concat(data_termino,' ',hora_termino)"), 
                '>', 
                DB::raw('NOW()')
            )
            ->get()
            ->take(3);

        $roundsNextWeek = SoccerExpertRound::where('soc_categoria_id', '=', $id)
            ->with(['games'])
            ->where(
                DB::raw("concat(data_termino,' ',hora_termino)"), 
                '>', 
                DB::raw('NOW()')
            )
            ->whereNotIn('id', $roundsWeek->pluck('id')->all())
            ->get()
            ->take(3);

        //$concatenated = $roundsWeek->concat($roundsNextWeek);

        $soccerExpert->ticketsWeek = $roundsWeek;
        $soccerExpert->ticketsNextWeek = $roundsNextWeek;

        /*$soccerExpertNextWeek = SoccerExpert::where('id', '=', $id)
            ->with(['rounds' => function($query) {
                
            }, 'rounds.games'])
            ->whereHas('rounds', function($query) {
                $query->where(
                    DB::raw("concat(data_termino,' ',hora_termino)"), 
                    '>', 
                    DB::raw('ADDDATE(NOW(), INTERVAL 14 DAY)')
                );
            })
            ->get()
            ->first();*/
        if(!is_null($soccerExpert)) {
            return response()->json($soccerExpert, 200);
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
