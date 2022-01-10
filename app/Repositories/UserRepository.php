<?php


namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function create($data)
    {
        return User::create([
            'name' => $data->name,
            'email' => $data->email,
            'google_id'=> $data->id,
        ]);
    }

    public function findByGoogleId($id)
    {
        return User::where('google_id', $id)->first();
    }
}
