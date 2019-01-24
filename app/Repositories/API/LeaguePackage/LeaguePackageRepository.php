<?php
/**
 * Created by PhpStorm.
 * User: gilsonmello
 * Date: 6/25/18
 * Time: 6:05 PM
 */

namespace App\Repositories\API\LeaguePackage;


use App\League;
use Illuminate\Http\Request;

class LeaguePackageRepository implements LeagueContract
{

    /**
     * @param Request $request
     * @return bool|mixed
     */
    public function create(Request $request)
    {
        return false;
    }

    /**
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, Request $request)
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