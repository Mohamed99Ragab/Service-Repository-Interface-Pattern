<?php

namespace App\Http\Controllers\API\V1;

use App\Core\Contracts\IAuthService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
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
}
