<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
    /**
     * @var AuthService
     */
    protected $authenticator;

    public function __construct(AuthService $authenticator)
    {
        $this->authenticator = $authenticator;
    }

    public function getLoginPage()
    {
        return view('auth.login');
    }

    public function getRegisterPage()
    {
        return view('auth.register');
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        $this->authenticator->login($data);
        return redirect('/home');
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $this->authenticator->register($data);
        return redirect('/home');
    }


    public function logout()
    {
        $this->authenticator->logout();
        return redirect('/login');
    }
}
