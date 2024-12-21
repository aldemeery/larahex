<?php

namespace Larahex\Contracts;

use Larahex\Entities\User;
use Symfony\Component\Uid\Uuid;

interface UserRepository
{
    public function find(Uuid $id): User;
}
