<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\League;
use App\LeagueAward;
use GuzzleHttp\Client;
class LeagueController extends Controller
{

    private function findTeamBySlug($slug) 
    {
        
    }

    public function classicTeams($slug)
    {
        $league = League::findBySlug($slug);
        $teams = $league->classicTeams;

        foreach($teams as $key => $team) {
            $client = new Client(['base_uri' => 'http://api.cartolafc.globo.com/']);
            $response = $client->request('GET', 'time/slug/'.$team->cartoleandoTeam->slug,  [
                'headers' => [
                    'x-glb-token' => env('X_GLB_TOKEN')
                ]
            ]);
            $body = json_decode($response->getBody());
            $team->team = $body;
        }

        if(!is_null($teams)) {
            return response()->json($teams, 200);
        }
        

        return response()->json([
            'message' => ''
        ], 422);
    }

    public function cupTeams($slug)
    {
        $league = League::findBySlug($slug);
        $teams = $league->cupTeams;
        foreach($teams as $key => $team) {
            $client = new Client(['base_uri' => 'http://api.cartolafc.globo.com/']);
            $response = $client->request('GET', 'time/slug/'.$team->cartoleandoTeam->slug,  [
                'headers' => [
                    'x-glb-token' => env('X_GLB_TOKEN')
                ]
            ]);
            $body = json_decode($response->getBody());
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
