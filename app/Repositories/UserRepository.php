<?php


namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return User::create($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findByGoogleId($id)
    {
        return User::where('google_id', $id)->first();
    }
}
