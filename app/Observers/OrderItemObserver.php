<?php

namespace App\Observers;

use App\OrderItem;
use App\SoccerExpertBet;
use App\SoccerExpertBetGame;
use App\ScratchCard;
use App\LotterySweepstake;
use App\SoccerExpertRoundGroup;
use App\HistoricBalance;
use App\Balance;
use App\LeaClassic;
use App\CartoleandoTeam;
use Illuminate\Support\Facades\DB;

class OrderItemObserver
{
    /**
     * Listen to the OrderItem created event.
     *
     * @param OrderItem $item
     */
    public function created(OrderItem $item)
    {
        //
    }

    /**
     * @param $item
     * @param $data
     * @return bool
     */
    private function lottery($item, $data, &$description) 
    {
        $sweepstake = LotterySweepstake::find($data->sweepstake->id);
        $data_fim = format_without_mask($sweepstake->data_fim, '/');

        //Pega a quantidade de datas de acordo com a teimosinha que o usuário escolheu
        $lotterySweepstakes = LotterySweepstake::where('lot_categoria_id', '=', $data->lottery->id)
            ->where('active', '=', 1)
            //->where(DB::raw("concat(data_fim,' ',hora_fim)"), '>=', date('Y-m-d H:i:s'))
            ->where(DB::raw("concat(data_fim,' ',hora_fim)"), '>=', $data_fim)
            ->orderBy('data_fim', 'ASC')
            ->orderBy('hora_fim', 'ASC')
            ->limit($data->duration)  
            ->get();

        $total = number_format($data->total, 2, '.', '');
        $description .= 'Compra no valor total de R$'. $total.'; ';
        $description .= count($lotterySweepstakes). ' teimosinha(s); ';
        $description .= count($data->tickets).' cartela(s); ';
        $description .= 'Tema '.$data->lottery->nome;

        //Percorrendo as datas
        foreach($lotterySweepstakes as $lotterySweepstake) {
            //Percorrendo todas as cartelas feitas pelo usuário
            foreach($data->tickets as $bet) {
                $lotteryUser = new \App\LotteryUser;

                //Atribuindo os dados para a aposta e salvando
                $lotteryUser->lot_jogo_id = $lotterySweepstake->id;
                $lotteryUser->jogador_id = $item->order->user_id;
                $lotteryUser->order_item_id = $item->id;
                $lotteryUser->duration = $data->duration;
                $lotteryUser->status = 1;
                $lotteryUser->save();

                //Pegando as dezenas selecionadas
                foreach($bet->numbers as $key => $number) {
                    $userNumber = new \App\LotteryUserNumber;
                    $userNumber->numero = $number;
                    $userNumber->lot_users_jogo_id = $lotteryUser->id;
                    $userNumber->save();                             
                }

                //Pegando as dezenas extras selecionadas
                foreach($bet->numbersExtras as $key => $number) {
                    $userNumber = new \App\LotteryUserNumberExtra;
                    $userNumber->numero = $number;
                    $userNumber->lot_users_jogo_id = $lotteryUser->id;
                    $userNumber->save();
                }
            }
        }
        return true;
    }

    /**
     * 
     */
    private function saveClassicLeague($item, $user_id, $league_id, $team, $leaClassic)
    {
        $leaClassicTeam = new \App\LeaClassicTeam;
        $leaClassicTeam->lea_classic_id = $leaClassic->id;
        $leaClassicTeam->owner_id = $user_id;
        $leaClassicTeam->item_id = $item->id;
        $leaClassicTeam->team_id = $team->id;
        $leaClassicTeam->save();
    }

    /**
     * 
     */
    private function saveCupLeague($item, $user_id, $league_id, $team, $leaCup)
    {
        $leaCupTeam = new \App\LeaCupTeam;
        $leaCupTeam->lea_cup_id = $leaCup->id;
        $leaCupTeam->owner_id = $user_id;
        $leaCupTeam->item_id = $item->id;
        $leaCupTeam->team_id = $team->id;
        $leaCupTeam->save();
    }

    /**
     * @param $item
     * @param $data
     * @return bool
     */
    private function cartoleando($item, $data, &$description) 
    {
        $order = $item->order;
        $user_id = $order->user_id;
        $team = CartoleandoTeam::where('owner_id', '=', $user_id)
            ->get()
            ->first();
        $league = \App\League::find($item->context_id);
        $league->quantity_teams++;
        $league->collected += $data->package->value;
        $league->save();       
        $total = number_format($data->package->value, 2, '.', '');
        $description .= 'Compra no valor total de R$'. $total.'; ';
        $description .= 'Liga '.$league->name.'; ';
        $description .= 'Pacote '.$data->package->name;
        if($league->classic != null && $league->context == 'classic') {
            $this->saveClassicLeague($item, $user_id, $league->id, $team, $league->classic);
        } else if($league->cup != null && $league->context == 'cup') {
            $this->saveCupLeague($item, $user_id, $league->id, $team, $league->cup);
        }        
    }

    /**
     * @param $item
     * @param $data
     * @return bool
     */
    private function soccerExpert($item, $data, &$description) 
    {
        $order = $item->order;
        $user_id = $order->user_id;
        $total = number_format($data->total, 2, '.', '');
        $description .= 'Compra no valor total de R$'. $total.'; ';
        $description .= count($data->tickets). ' cartela(s); ';
        $description .= 'Soccer Expert '.$data->soccer_expert->nome;
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

    /**
     * @param $item
     * @param $data
     * @return bool
     */
    private function scratchCard($item, $data, &$description) 
    {
        //Pegando raspadinhas com base na quantidade selecionado pelo o usuário
        //E pega aleatório
        $scratchCards = ScratchCard::select('id', 'owner')
            ->where('temas_raspadinha_id', '=', $data->scratch_card->id)
            ->orderByRaw('RAND()')
            ->limit($data->scratch_card->discount_tables->quantity)
            ->get();

        $total = number_format($data->total, 2, '.', '');

        $description .= 'Compra no valor total de R$'. $total.'; ';
        $description .= $data->scratch_card->discount_tables->quantity .' raspadinha(s);';
        $description .= ' Tema '.$data->scratch_card->nome;

        //Atribuindo a raspadinha para o dono
        foreach($scratchCards as $scratchCard) {
            $scratchCard->owner = $item->order->user_id;
            $scratchCard->order_item_id = $item->id;
            $scratchCard->save();
        }
        return true;
    }

    /**
     * @param OrderItem $item
     */
    public function saved(OrderItem $item)
    {
        $data = json_decode($item->data);

        $description = '';
        $message = '';
        if($item->type == 'lottery') {
            $this->lottery($item, $data, $description);
        } else if($item->type == 'soccer_expert') {
            $this->soccerExpert($item, $data, $description);
        } else if($item->type == 'scratch_card') {
            $this->scratchCard($item, $data, $description);
        } else if($item->type == 'cartoleando') {
            $this->cartoleando($item, $data, $description);
        }

        $order = $item->order;

        $balance = Balance::where('owner_id', '=', $order->user_id)->get()->first();
        $historicBalance = new HistoricBalance;
        $historicBalance->owner_id = $order->user_id;
        $historicBalance->from = $balance->value;
        $historicBalance->to = $balance->value - $data->total;
        $historicBalance->balance_id = $balance->id;
        //$historicBalance->item_id = $item->id;
        $historicBalance->description = $description;
        $historicBalance->context = 'order_items';
        $historicBalance->context_message = 'buy';
        $historicBalance->modality = 'buy';
        $historicBalance->type = 0;
        $historicBalance->amount = $data->total * -1;
        $historicBalance->system = 1;
        
        $historicBalance->save();
        
        $balance->value = $balance->value - $data->total;
        
        $balance->save();

        DB::table('order_items')
            ->where('id', $item->id)
            ->update([
                'data' => null, 
                'historic_balance_id' => $historicBalance->id
            ]);
    }

    /**
     * Listen to the User deleting event.
     *
     * @param OrderItem $item
     * @return void
     */
    public function deleting(OrderItem $item)
    {
        //
    }
}