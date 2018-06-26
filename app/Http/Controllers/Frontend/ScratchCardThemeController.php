<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ScratchCardTheme;
use App\ScratchCardDemo;
use App\ScratchCard;
use App\ScratchCardDiscountTable;
use Illuminate\Support\Facades\DB;

class ScratchCardThemeController extends Controller
{
    
    public function jackpotAvailable($id = null){
        $jackpotAvailable = ScratchCardTheme::with([
            'jackpotTables' => function($query) {
                $query->orderBy('quantia', 'DESC');
            }
        ])
        ->whereHas('jackpotTables')
        ->where('id', '=', $id)
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

    public function scratchCard(Request $request, $id)
    {
        return ScratchCardTheme::where('id', '=', $id)
            ->get()
            ->first();
    }

    public function changeScratchCard(Request $request, $scratch_card_id, $theme_id, $user_id) 
    {
        $scratchCard = ScratchCard::find($scratch_card_id);
        
        $scratchCard->ativo = 1;
        if($scratchCard->save()) {

            $scratchCard = ScratchCard::select([
                'temas_raspadinha_id', 
                'owner',
                DB::raw('count(temas_raspadinha_id) as quantity')
            ])
            ->where('owner', '=', $user_id)
            ->where('temas_raspadinha_id', '=', $theme_id)
            ->where('ativo', '=', 0)
            ->groupBy([
                'temas_raspadinha_id', 
                'owner'
            ])
            ->get()
            ->first();

            return response()->json($scratchCard, 200);
        }
        return response()->json(['msg' => trans('strings.not_found_demo')], 422);
    }

    public function play($id, $user_id) 
    {
        $scratchCard = ScratchCard::where('owner', '=', $user_id)
            ->where('temas_raspadinha_id', '=', $id)
            ->where('ativo', '=', 0)
            ->orderByRaw('RAND()')
            ->get()
            ->first();
        if($scratchCard) {
            return response()->json($scratchCard, 200);
        }
        return response()->json(['msg' => ''], 422);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $user_id = $request->get('user_id') != null ? $request->get('user_id') : 0;
        
        $theme = ScratchCardTheme::whereHas('lot', function($query) {
            $query->where('active', '=', 1);
        })
        ->with([
            'lot'
        ])
        ->get()
        ->makeHidden(['total_tickets']);

        foreach($theme as $key => $value) {
            
            //Pegando o total de raspadinhas do usuário logado
            $value->has_scratch_card = ScratchCard::select([
                'temas_raspadinha_id', 
                'owner',
                DB::raw('count(temas_raspadinha_id) as quantity')
            ])
            ->where('owner', '=', $user_id)
            ->where('temas_raspadinha_id', '=', $value->id)
            ->where('ativo', '=', 0)
            ->groupBy([
                'temas_raspadinha_id', 
                'owner'
            ])
            ->get()
            ->first();

            //Pegando todos os descontos se a quantidade disponível for maior do que a quantidade do desconto
            $discountTable = ScratchCardDiscountTable::where('tema_id', '=', $value->id)
            ->select([
                'id', 
                'tema_id',
                'quantity',
                'percentage',
                'is_discount',
                'created',
                'modified',
                'active'
            ])
            ->where('active', '=', 1)
            ->where('quantity', '<=', $value->total_tickets_available)
            ->get();

            $value->discount_tables = $discountTable != null ? $discountTable : [] ;
        }

        return response()->json($theme, 200);
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
        return ScratchCardTheme::where('id', '=', $id)
            ->get()
            ->first();
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
