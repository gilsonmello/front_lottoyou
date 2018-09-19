<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\League;
use App\LeagueAward;
use GuzzleHttp\Client;
use App\Traits\Cartoleando;
class LeagueController extends Controller
{
    use Cartoleando;

    private function findTeamBySlug($slug) 
    {
        
    }

    public function classicTeams($slug)
    {
        $league = League::findBySlug($slug);
        $leaClassic = $league->classic;
        //Tipos de ordenamentos
        $typeOrders = [
            0 => '',
            1 => 'p_c',
            2 => 'p_m',
            3 => 'p_m',
            4 => 'p_p',
            5 => 'p_r',
        ];
        $typeOrder = $typeOrders[$leaClassic->type_award_id];
        $teams = $leaClassic->teams()
            ->orderBy($typeOrder, 'DESC')
            ->get();

        foreach($teams as $key => $team) {
            $body = $this->getTeamFromCartola($team->cartoleandoTeam->slug);
            $team->team = $body;
        }

        if(!is_null($teams)) {
            return response()->json($teams, 200);
        }        

        return response()->json([
            'message' => ''
        ], 422);
    }

    public function cupSteps($slug)
    {
        $league = League::findBySlug($slug);
        $leaCup = $league->cup;
        $steps = $leaCup->steps()
            ->where('active', '=', 1)
            ->orWhere('updated', '=', 1)
            ->orderBy('id', 'desc')
            ->orderBy('current_step', 'desc')
            ->get();
        
        foreach($steps as $step) {
            $keys = \App\LeaCupKey::where('lea_cup_step_id', '=', $step->id)
                ->where('finished', '=', 1)
                ->get();
                
            foreach($keys as $key) {
                $homeTeam = $key->homeTeam;                
                if(!$homeTeam) {
                    continue;
                }

                $key->homeTeam = $this->getTeamFromCartola($homeTeam->slug);

                $outTeam = $key->outTeam;
                $key->outTeam = $this->getTeamFromCartola($outTeam->slug);

                if($key->finished == 1) {
                    $winner = $key->winner;
                    $key->winner = $this->getTeamFromCartola($winner->slug);
                    $loser = $key->loser;
                    $key->loser = $this->getTeamFromCartola($loser->slug);
                }
            }
            $step->keys = $keys;
        }

        if(!is_null($steps)) {
            return response()->json($steps, 200);
        }

        return response()->json([
            'message' => ''
        ], 422);
    }

    public function cupTeams($slug)
    {
        $league = League::findBySlug($slug);
        $leaCup = $league->cup;
        $teams = $leaCup->teams;
        foreach($teams as $key => $team) {
            $body = $this->getTeamFromCartola($team->cartoleandoTeam->slug);
            $team->team = $body;
        }

        if(!is_null($teams)) {
            return response()->json($teams, 200);
        }        

        return response()->json([
            'message' => ''
        ], 422);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function awards($slug)
    {
        $league = League::findBySlug($slug);
        return LeagueAward::where('league_id', '=', $league->id)
            ->orderBy('position', 'asc')
            ->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return League::where('active', '=', 1)
            ->where('open', '=', 1)
            ->get();
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
        $league = \App\League::findBySlug($slug);

        if(!is_null($league)) return response()->json($league, 200);

        return response()->json([
            'message' => ''
        ], 422);
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
