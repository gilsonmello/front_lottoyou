<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\LeaguePackage;
use App\League;
use DB;

class LeaguePackageController extends Controller
{ 
    /**
     * Busca as ligas que estão dentro do pacote 
     *
     * @param $slug
     * @return \Illuminate\Http\Response
     */
    public function findLeaguesBySlug($slug)
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
            'cup',
            'classic'
        ])->get();

        if($leagues == null) {
            return response()->json([], 402);
        }

        return response()->json($leagues, 200);
    }

    /**
     * Busca o pacote e as ligas 
     *
     * @param $slug
     * @return \Illuminate\Http\Response
     */
    public function findBySlug($slug)
    {
        $package = LeaguePackage::findBySlug($slug);

        if($package == null) {
            return response()->json([], 402);
        }

        return response()->json($package, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = LeaguePackage::where('active', '=', 1)->get();

        if($packages->isEmpty()) {
            return response()->json([], 402);
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
