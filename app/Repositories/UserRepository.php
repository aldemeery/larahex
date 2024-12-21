<?php

namespace App\Repositories;

use App\Models\User as UserModel;
use Larahex\Contracts\UserRepository as UserRepositoryContract;
use Larahex\Entities\User;
use Symfony\Component\Uid\Uuid;

class UserRepository implements UserRepositoryContract
{
    public function find(Uuid $id): User
    {
        $user = UserModel::findOrFail($id->toString());

        return new User($id, $user->name, $user->email, $user->password);
    }
}
