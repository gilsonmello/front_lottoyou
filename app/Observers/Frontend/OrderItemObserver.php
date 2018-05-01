<?php

namespace App\Observers\Frontend;

use App\Model\Frontend\OrderItem;
use App\Model\Frontend\SoccerExpertBet;
use App\Model\Frontend\ScratchCard;
use App\Model\Frontend\LotteryUser;

class OrderItemObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(OrderItem $item)
    {
        //
    }

    private function lottery($item, $data) 
    {
        //Percorrendo todas as cartelas feitas pelo usuário
        foreach($data->betting as $bet) {
            $lotteryUser = new LotteryUser;

            //Pegando as dezenas selecionadas
            foreach($bet->numbers as $key => $number) {

                //Concatenando os números
                if($key == (count($bet->numbers) - 1)) {
                    $lotteryUser->numeros .= $number;
                } else {
                    $lotteryUser->numeros .= $number.' - ';
                }                    
            }

            //Pegando as dezenas extras selecionadas
            foreach($bet->numbersExtras as $key => $number) {

                //Concatenando os números
                if($key == (count($bet->numbersExtras) - 1)) {
                    $lotteryUser->numeros .= $number;
                } else {
                    $lotteryUser->numeros .=  $number.' + ';
                }
            }

            //Atribuindo os dados para a aposta e salvando
            $lotteryUser->lot_jogo_id = $data->sweepstake->id;
            $lotteryUser->jogador_id = $item->order->user_id;
            $lotteryUser->status = 1;
            $lotteryUser->save();
        }
        return true;
    }

    private function soccerExpert($item, $data) 
    {
        //Percorrendo as cartelas feitas pelo o usuário
        foreach($data->tickets as $key => $ticket) {
            //Percorrendo os jogos feitos
            foreach ($ticket->games as $game) {

                //Salvando os jogos feitos na tabela de apostas
                $soccerExpertBet = new SoccerExpertBet;
                $soccerExpertBet->user_id = $item->order->user_id;
                $soccerExpertBet->soc_rodada_id = $game->soc_rodada_id;
                $soccerExpertBet->soc_jogo_id = $game->id;
                $soccerExpertBet->resultado_clube_casa = $game->result_house_club;
                $soccerExpertBet->resultado_clube_fora = $game->result_out_club;
                $soccerExpertBet->bola_ouro = $game->bola_ouro;
                $soccerExpertBet->save();
            }
        }

        return true;
    }


    private function scratchCard($item, $data) 
    {
        //Pegando raspadinhas com base na quantidade selecionado pelo o usuário
        //E pega aleatório
        $scratchCards = ScratchCard::select('id', 'owner')
            ->where('temas_raspadinha_id', '=', $data->scratch_card->id)
            ->orderByRaw('RAND()')
            ->limit($data->scratch_card->discount_tables->quantity)
            ->get();

        //Atribuindo a raspadinha para o dono
        foreach($scratchCards as $scratchCard) {
            $scratchCard->owner = $item->order->user_id;
            $scratchCard->save();
        }
        return true;
    }

    public function saved(OrderItem $item)
    {
        $data = json_decode($item->data);
        
        if($item->type == 'lottery') {
            $this->lottery($item, $data);
        } else if($item->type == 'soccer_expert') {
            $this->soccerExpert($item, $data);
        } else if($item->type == 'scratch_card') {
            $this->scratchCard($item, $data);
        }
    }

    /**
     * Listen to the User deleting event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleting(OrderItem $item)
    {
        //
    }
}