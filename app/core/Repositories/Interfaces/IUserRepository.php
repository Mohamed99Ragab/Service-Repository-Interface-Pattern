<?php

namespace App\Core\Repositories\Interfaces;

use App\Models\User;

interface IUserRepository {

    public function updatePassword(User $user, array $data);
}