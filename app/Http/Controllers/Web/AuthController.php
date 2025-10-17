<?php

namespace App\Http\Controllers\Web;

use App\Core\Contracts\IAuthService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Auth\LoginRequest;
use App\Http\Requests\Web\Auth\RegisterRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function __construct(protected IAuthService $authService) {

    }
    public function login(LoginRequest $request) {

        return $this->authService->login($request->validated());
    }
    
    public function register(RegisterRequest $request) {

        return $this->authService->register($request->validated());
    }  

    public function loginPage() {

        return view('auth.login');
    }

    public function registerPage() {

        return view('auth.register');
    }
}
