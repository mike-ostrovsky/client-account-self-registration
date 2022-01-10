<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * @var AuthService
     */
    private $authService;

    /**
     * GoogleController constructor.
     * @param AuthService $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->authService= $authService;
    }

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $user = Socialite::driver('google')->stateless()->user();
        $this->authService->authorizeWithGoogle($user);
        return redirect('/home');
    }
}
