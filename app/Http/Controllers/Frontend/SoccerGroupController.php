<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Frontend\SoccerExpertRoundGroup;
use App\Model\Frontend\SoccerExpertBet;
use App\User;

class SoccerGroupController extends Controller
{
    public function find($id)
    {
        return SoccerExpertRoundGroup::find($id);
    }

    public function ranking($id, Request $request) 
    {        
        $bets = SoccerExpertBet::where('soc_rodada_grupo_id', '=', $id)
            ->with([
                'owner' => function($query) use($request) {
                    $query->select('id', 'nickname', 'name', 'photo');
                }
            ])
            ->whereHas('owner', function($query) use($request) {
                if($request->get('nickname')) {
                    $query->where('nickname', 'LIKE', '%'.$request->get('nickname').'%');
                }
            })
            ->selectRaw('SUM(pontuacao) as pontuacao, owner_id')
            ->groupBy('owner_id');

        if($request->get('column')) {
            $bets->orderBy($request->get('column'), $request->get('direction'));
        }
        

        $bets = $bets
            ->orderBy('pontuacao', 'desc')
            ->paginate(20);

        return response()->json($bets, 200);
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