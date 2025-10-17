<?php

namespace App\Core\Contracts;

interface IAuthService
{
    public function login(array $data);
    public function logout();
    public function register(array $data);
    public function user();
    public function updateProfile(array $data);
    public function updatePassword(array $data);
    public function forgetPassword(array $data);
}