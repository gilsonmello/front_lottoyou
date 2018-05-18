<?php

namespace App\Observers\Frontend;

use App\Model\Frontend\OrderItem;
use App\Model\Frontend\SoccerExpertBet;
use App\Model\Frontend\SoccerExpertBetGame;
use App\Model\Frontend\ScratchCard;
use App\Model\Frontend\LotteryUser;
use App\Model\Frontend\LotteryUserNumber;
use App\Model\Frontend\LotteryUserNumberExtra;
use App\Model\Frontend\SoccerExpertRoundGroup;
use App\Model\Frontend\SoccerExpertRound;

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
        foreach($data->tickets as $bet) {
            $lotteryUser = new LotteryUser;

            //Atribuindo os dados para a aposta e salvando
            $lotteryUser->lot_jogo_id = $data->sweepstake->id;
            $lotteryUser->jogador_id = $item->order->user_id;
            $lotteryUser->status = 1;
            $lotteryUser->save();

            //Pegando as dezenas selecionadas
            foreach($bet->numbers as $key => $number) {
                $userNumber = new LotteryUserNumber;
                $userNumber->numero = $number;
                $userNumber->lot_users_jogo_id = $lotteryUser->id;
                $userNumber->save();                             
            }

            //Pegando as dezenas extras selecionadas
            foreach($bet->numbersExtras as $key => $number) {
                $userNumber = new LotteryUserNumberExtra;
                $userNumber->numero = $number;
                $userNumber->lot_users_jogo_id = $lotteryUser->id;
                $userNumber->save();
            }

        }
        return true;
    }

    private function soccerExpert($item, $data) 
    {
        $order = $item->order;
        $user_id = $order->user_id;
        //Percorrendo as cartelas feitas pelo o usuário
        foreach($data->tickets as $key => $ticket) {
            //Pegando o grupo atual da rodada
            $ticket_group = SoccerExpertRoundGroup::where('soc_rodada_id', '=', $ticket->id)
                ->where('status', '=', 1)
                ->get()
                ->first();

            if(is_null($ticket_group)) {
                $ticket_group = new SoccerExpertRoundGroup;
                $ticket_group->soc_rodada_id = $ticket->id;
                $ticket_group->count  = 0;
                $ticket_group->active = 1;
                $ticket_group->status = 1;
                $ticket_group->identificacao += 1;
                $ticket_group->save();
            }


            //Se a rodada for limitada
            if($ticket->limite != null) {
                //Verifico se a quantidade de usuário já chegou até o limite, caso sim, 
                //Desativo o grupo atual e o crio outro grupo
                if($ticket_group->count == $ticket->limite) {
                    $ticket_group->status = 0;
                    $identificacao = $ticket_group->identificacao;
                    $ticket_group->save();
                    $ticket_group = new SoccerExpertRoundGroup;
                    $ticket_group->soc_rodada_id = $ticket->id;
                    $ticket_group->count += 1;
                    $ticket_group->active = 1;
                    $ticket_group->status = 1;
                    $ticket_group->identificacao = $identificacao + 1;
                    $ticket_group->arrecadado = 0.00;
                    $ticket_group->save();
                    //$ticket_group->users()->attach($user_id, ['points' => 0]);
                } else {
                    //Se não, vou adicionando usuários ao grupo
                    $ticket_group->arrecadado += $ticket->valor;
                    $ticket_group->count += 1;
                    $ticket_group->save();
                    //$ticket_group->users()->attach($user_id, ['points' => 0]);
                }              
            } else {
                //Se a rodada for ilimitada, vou adicionando usuários ao grupo
                $ticket_group->arrecadado += $ticket->valor;
                $ticket_group->count += 1;
                $ticket_group->save();
                //$ticket_group->users()->attach($user_id, ['points' => 0]);
            }

            $soccerExpertBet = SoccerExpertBet::select([
                    'owner_id',
                    'soc_rodada_grupo_id',
                    'num_compras'
                ])
                ->where('owner_id', '=', $user_id)
                ->where('soc_rodada_grupo_id', '=', $ticket_group->id)
                ->groupBy(['owner_id', 'soc_rodada_grupo_id', 'num_compras'])
                ->orderBy('num_compras', 'desc')
                ->get()
                ->first();
            
            $num_compras = 1;
                    
            if(!is_null($soccerExpertBet)) {
                $num_compras += $soccerExpertBet->num_compras;
            }

            $soccerExpertBet = new SoccerExpertBet;
            $soccerExpertBet->owner_id = $user_id;
            $soccerExpertBet->soc_rodada_id = $ticket->id;
            $soccerExpertBet->soc_rodada_grupo_id = $ticket_group->id;
            $soccerExpertBet->num_compras = $num_compras;
            $soccerExpertBet->order_item_id = $item->id;
            $soccerExpertBet->save();

            //Percorrendo os jogos feitos
            foreach ($ticket->games as $game) {

                //Salvando os jogos feitos na tabela de apostas
                $soccerExpertBetGame = new SoccerExpertBetGame;
                $soccerExpertBetGame->soc_aposta_id = $soccerExpertBet->id;
                $soccerExpertBetGame->soc_jogo_id = $game->id;
                $soccerExpertBetGame->resultado_clube_casa = $game->result_house_club;
                $soccerExpertBetGame->resultado_clube_fora = $game->result_out_club;
                $soccerExpertBetGame->bola_ouro = $game->bola_ouro;
                $soccerExpertBetGame->save();
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
            $scratchCard->order_id = $item->order->id;
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