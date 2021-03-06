<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SoccerExpert;
use App\SoccerExpertRound;
use App\SoccerExpertCycle;
use Illuminate\Support\Facades\DB;

class SoccerExpertController extends Controller
{
    public function ranks($slug, Request $request) 
    {
        $soccer = SoccerExpert::findBySlug($slug);
        
        $tickets = SoccerExpertRound::where('soc_categoria_id', '=', $soccer->id)
            ->where('fechada', '=', 1);

        $tickets = $tickets->paginate();

        return view('frontend.soccer_expert.ranks')
            ->with('soccer', $soccer)
            ->with('tickets', $tickets);
        
        /*$bets = SoccerExpertBet::whereHas('round', function($query) use($id) {
            $query->where('soc_categoria_id', '=', $id);
        });

        $column = $request->get('column'); 
        $direction = $request->get('direction'); 

        $bets = $bets->with([
            'owner' => function($query) use ($column, $direction){
                $query->where('nickname', 'LIKE', '%gilson%');
            }
        ])->paginate(2);

        return response()->json($bets, 200);   */    
    }

    public function results($slug, Request $request) 
    {
        $soccer = SoccerExpert::where('slug', '=', $slug)->get()->first();
        $tickets = SoccerExpertRound::where('soc_categoria_id', '=', $soccer->id)
            ->paginate();

        return view('frontend.soccer_expert.results')
            ->with('soccer', $soccer)
            ->with('tickets', $tickets);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function play($slug)
    {
        $soccerExpert = SoccerExpert::where('slug', '=', $slug)
            ->select(
                'id', 
                'slug',
                'nome',
                'imagem_capa',
                'active',
                'ordem',
                'novo',
                'created',
                'modified'
            )->get()
            ->first();

        return view('frontend.soccer_expert.play')
            ->with('soccer', $soccerExpert);

    }

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
        $soccerCategories = SoccerExpert::where('active', '=', 1)
            ->get();

        return view('frontend.soccer_expert.index')
            ->with('soccers', $soccerCategories);
    }

    public function find($slug) 
    {
        dd($slug);
        return SoccerExpert::findBySlug($slug);
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
        $soccerExpert = SoccerExpert::where('id', '=', $id)
            ->select(
                'id', 
                'nome',
                'imagem_capa',
                'active',
                'ordem',
                'novo',
                'created',
                'modified'
            )->get()
            ->first();


        $cycles = SoccerExpertCycle::where('soc_categoria_id', '=', $id)
            ->whereHas('rounds', function ($query) {
                $query->where(
                    DB::raw("concat(data_termino,' ',hora_termino)"), 
                    '>=', 
                    date('Y-m-d H:i:s')
                )->where('active', '=', 1);
            })
            ->with([
                'rounds' => function($query) {
                    $query->select([
                        'id', 
                        'soc_bolao_id',
                        'tipo',
                        'nome',
                        'imagem_capa',
                        'valor',
                        'data_termino',
                        'hora_termino',
                        'limite',
                        'minimo',
                        'active',
                        'created',
                        'modified',
                        'soc_categoria_id',
                        'soc_ciclo_id',
                        'imagem_modal',
                        DB::raw("concat(data_termino,' ',hora_termino) as date_end")
                    ])
                    ->where(
                        DB::raw("concat(data_termino,' ',hora_termino)"), 
                        '>=', 
                        date('Y-m-d H:i:s')
                    )->where('active', '=', 1)
                    ->orderBy('date_end', 'asc');
                },
                'rounds.games' => function($query) {
                    $query->select([
                        'id', 
                        'user_id',
                        'soc_rodada_id',
                        'soc_bolao_id',
                        'gel_clube_casa_id',
                        'gel_clube_fora_id',
                        'resultado_clube_casa',
                        'resultado_clube_fora',
                        'local',
                        'data',
                        'hora',
                        'data_termino',
                        'hora_termino',
                        'active',
                        'created',
                        'modified',
                        DB::raw("concat(data,' ',hora) as date_end")
                    ])->where('active', '=', 1)
                    ->orderBy('date_end', 'asc');
                },
                'rounds.sweepstake',
                'rounds.group',
                'rounds.games.houseClub',
                'rounds.games.outClub',
            ])
            ->whereHas('rounds.games.houseClub', function($query) {
                $query->where('active', '=', 1);
            })
            ->whereHas('rounds.games.outClub', function($query) {
                $query->where('active', '=', 1);
            })
            ->where(
                DB::raw("concat(data_inicio,' ',hora_inicio)"), 
                '<=', 
                date('Y-m-d H:i:s')
            )
            ->where(
                DB::raw("concat(data_fim,' ',hora_fim)"), 
                '>=', 
                date('Y-m-d H:i:s')
            )
            ->where('active', '=', 1)
            ->get();

        /*return response()->json($cycles, 200);

        $roundsNextWeek = SoccerExpertRound::where('soc_categoria_id', '=', $id)
            ->with(['games', 'sweepstake', 'group'])
            ->where(
                DB::raw("concat(data_termino,' ',hora_termino)"), 
                '>', 
                date('Y-m-d H:i:s')
            )
            ->whereNotIn('id', $roundsWeek->pluck('id')->all())
            ->get()
            ->take(3);

        //$concatenated = $roundsWeek->concat($roundsNextWeek);

        $soccerExpert->ticketsWeek = $roundsWeek;
        $soccerExpert->ticketsNextWeek = $roundsNextWeek;*/
        $soccerExpert->cycles = $cycles;

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
