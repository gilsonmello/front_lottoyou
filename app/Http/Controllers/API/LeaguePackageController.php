<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\LeaguePackage;
use App\League;
use DB;

class LeaguePackageController extends Controller
{ 
    public function __construct()
    {
        if(isset(request()->header()['authorization'])) {
            $this->middleware('auth:api');
        }
    }

    /**
     * Busca as ligas que estão dentro do pacote 
     *
     * @param $slug
     * @return \Illuminate\Http\Response
     */
    public function findLeaguesBySlug($slug, Request $request)
    {
        $leagues = League::select('*', DB::raw("
        (
            CASE WHEN leagues.context = 'classic' THEN 'Clássica' 
            WHEN leagues.context = 'cup' THEN 'Mata Mata'
            ELSE 'Clássica' 
            END
        ) AS modality
        "))
        ->whereHas('packages', function($query) use ($slug) {
            $query->where('slug', '=', $slug);
        })->with([
            'awards' => function($query) {
                $query->orderBy('position', 'asc');
            },
            'cup',
            'classic'
        ])->get();

        if($leagues == null) {
            return response()->json([], 422);
        }

        /* $leagues = $leagues->filter(function ($league, $key) {
            if($league->context == 'cup') {
                if($league->quantity_teams == $league->number_team) {
                    return false;
                }
            } else if($league->context == 'classic') {
                if($league->quantity_teams == $league->classic->max_players) {
                    return false;
                }
            }
            return true;
        }); */

        return response()->json($leagues, 200);
    }

    /**
     * Busca o pacote e as ligas 
     *
     * @param $slug
     * @return \Illuminate\Http\Response
     */
    public function findBySlug($slug, Request $request)
    {
        $package = LeaguePackage::findBySlug($slug);

        if($package == null) {
            return response()->json([], 422);
        }

        return response()->json($package, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $packages = LeaguePackage::where('active', '=', 1);

        //Se o usuário estiver logado, evitar que o pacote apareça para ele novamente
        if($user) {
            /* $itemsIDS = \App\OrderItem::where('user_id', '=', $user->id)
                ->select([
                    'lea_package_id'
                ])
                ->where('type', '=', 'cartoleando')
                ->groupBy([
                    'lea_package_id'
                ])
                ->get()
                ->pluck('lea_package_id')
                ->all();
            $packages->whereNotIn('id', $itemsIDS); */
        }

        $packages = $packages->get();

        if($packages->isEmpty()) {
            return response()->json([], 422);
        }

        return response()->json($packages, 200);
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
