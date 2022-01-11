<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Contracts\User;

class AuthService {

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * AuthService constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function authorizeWithGoogle(User $socialiteUser)
    {
        $user = $this->userRepository->findByGoogleId($socialiteUser->id);

        if (!$user){
            $normalized = [
                'name' => $socialiteUser->name,
                'email' => $socialiteUser->email,
                'google_id'=> $socialiteUser->id,
            ];
            $user = $this->userRepository->create($normalized);
        }

        Auth::login($user);
    }

    public function login($data)
    {
        Auth::attempt($data);
    }

    public function register($data)
    {
        $user = $this->userRepository->create($data);

        Auth::login($user);
    }

    public function logout()
    {
        Session::flush();
        return empty(Session::all());
    }
}
