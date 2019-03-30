<?php

namespace App\Observers;

use App\ScratchCard;
use App\Balance;
use App\HistoricBalance;

class ScratchCardObserver
{
    /**
     * Listen to the User created event.
     *
     * @param ScratchCard $scratchCard
     * @return void
     */
    public function created(ScratchCard $scratchCard)
    {
        //
    }

    /**
     * @param ScratchCard $scratchCard
     */
    public function saved(ScratchCard $scratchCard)
    {
        if($scratchCard->premio > 0) {
            $balance = Balance::where('owner_id', '=', $scratchCard->owner)->get()->first();
            
            $lot = $scratchCard->lot;
            $theme = $scratchCard->theme;

            $historicBalance = new HistoricBalance;
            $historicBalance->owner_id = $balance->owner_id;
            $historicBalance->balance_id = $balance->id;
            $historicBalance->from = $balance->value;
            //$historicBalance->scratch_card_id = $scratchCard->id;
            $historicBalance->to = $balance->value + $scratchCard->premio;
            $historicBalance->modality = 'award';
            $historicBalance->description = 'Lote '.$lot->nome;
            $historicBalance->description .= '; Tema '.$theme->nome;
            $historicBalance->context = 'raspadinhas';
            $historicBalance->context_message = 'award.scratch_card';
            $historicBalance->context_id = $scratchCard->id;
            $historicBalance->type = 1;
            $historicBalance->system = 0;
            $historicBalance->amount = $scratchCard->premio;
            $historicBalance->save();

            $balance->value += $scratchCard->premio;
            $balance->save();

            \DB::table('raspadinhas')
                ->where('id', $scratchCard->id)
			    ->update(['historic_balance_id' => $historicBalance->id]);
        }
    }

    /**
     * Listen to the User deleting event.
     *
     * @param ScratchCard $scratchCard
     * @return void
     */
    public function deleting(ScratchCard $scratchCard)
    {
        //
    }
}