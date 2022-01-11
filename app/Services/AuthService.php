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

    /**
     * @param User $socialiteUser
     */
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

    /**
     * @param $data
     */
    public function login($data)
    {
        Auth::attempt($data);
    }

    /**
     * @param $data
     */
    public function register($data)
    {
        $user = $this->userRepository->create($data);

        Auth::login($user);
    }

    /**
     * @return bool
     */
    public function logout(): bool
    {
        Session::flush();

        return empty(Session::all());
    }
}
