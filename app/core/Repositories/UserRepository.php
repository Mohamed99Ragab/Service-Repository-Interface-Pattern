<?php
namespace App\Core\Repositories;

use App\Core\Repositories\Interfaces\IUserRepository;
use App\Models\User;

class UserRepository extends BaseRepository implements IUserRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }


    public function updatePassword(User $user, array $data)
    {
        $user->update($data);
        return $user;
    }

}