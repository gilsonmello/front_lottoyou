<?php namespace App\Repositories\Frontend\User;

interface UserContract
{
    /**
     * @param string $hash
     * @return mixed
     */
    public function activate(string $hash);

    /**
     * @param array $attributes
     * @return mixed
     */
	public function create(array $attributes);

    /**
     * @param $id
     * @param array $attributes
     * @return mixed
     */
	public function update($id, array $attributes);

    /**
     * @param $id
     * @return mixed
     */
	public function delete($id);
}