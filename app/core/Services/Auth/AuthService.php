<?php

namespace App\Core\Services\Auth;

use App\Core\Contracts\IAuthService;
use App\Core\Repositories\UserRepository;

class AuthService implements IAuthService
{
    public function __construct(protected UserRepository $userRepository)
    {
        //
    }

    public function user()
    {
        return auth()->user();
    }

    public function logout()
    {
        auth()->logout();

        return true;
    }

    public function login(array $data)
    {
        if (!auth()->attempt($data)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        return auth()->user();
    }

    public function register(array $data)
    {
        return $this->userRepository->create($data);
    }

    public function updateProfile(array $data)
    {
        $user = auth()->user();
        return $this->userRepository->update($user,$data);
    }

    public function updatePassword(array $data)
    {
        $user = auth()->user();
        return $this->userRepository->updatePassword($user,$data);
    }

    public function forgetPassword(array $data)
    {
        //

    }


}