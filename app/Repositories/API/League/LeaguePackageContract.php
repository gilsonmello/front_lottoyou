<?php
/**
 * Created by PhpStorm.
 * User: gilsonmello
 * Date: 6/25/18
 * Time: 6:05 PM
 */

namespace App\Repositories\API\LeaguePackage;

use Illuminate\Http\Request;

interface LeaguePackageContract
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function create(Request $request);

    /**
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, Request $request);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);
}