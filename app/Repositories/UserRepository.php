<?php


namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function create($data)
    {
        return User::create($data);
    }

    public function findByGoogleId($id)
    {
        return User::where('google_id', $id)->first();
    }
}
