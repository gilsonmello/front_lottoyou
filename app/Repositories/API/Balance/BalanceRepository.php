<?php
/**
 * Created by PhpStorm.
 * User: gilsonmello
 * Date: 6/25/18
 * Time: 6:05 PM
 */

namespace App\Repositories\API\Balance;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\User;
use App\Balance;
use App\HistoricBalance;
use App\BalanceWithdraw;
use Illuminate\Support\Facades\DB;

class BalanceRepository implements BalanceContract
{
    /**
     * @param $request
     */
    public function withdraw($request)
    {
        DB::beginTransaction();

        //Caso ocorra algum erro de SQL, é feito o rollback
        try {
            $user = User::findOrFail($request->owner_id);

            $balance = Balance::where('owner_id', '=', $user->id)->get()->first();
            
            $historicBalance = new HistoricBalance;
            $historicBalance->owner_id = $user->id;
            $historicBalance->balance_id = $balance->id;
            $historicBalance->from = $balance->value;
            
            $balanceWithdraw = new BalanceWithdraw;
            $balanceWithdraw->owner_id = $user->id;
            $balanceWithdraw->value = $request->value;
            $save = $balanceWithdraw->save();
            
            $balance->value -= $request->value;
            $save = $balance->save();

            $historicBalance->balance_withdraw_id = $balanceWithdraw->id;
            $historicBalance->to = $balance->value;
            $save = $historicBalance->save();

            DB::commit();
            return true;
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            return false;
        } catch (\PDOException $e) {
            DB::rollBack();
            return false;
        }
        return false;
    }

    /**
     * @param Request $request
     * @return bool|mixed
     */
    public function create(Request $request)
    {
        
    }

    /**
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, array $attributes)
    {
        // TODO: Implement update() method.
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}