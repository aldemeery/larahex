<?php

namespace Larahex\Contracts;

use Larahex\Entities\Todo;
use Larahex\Entities\User;
use Symfony\Component\Uid\Uuid;

interface TodoRepository
{
    public function find(Uuid $id): Todo;

    public function persist(Todo $todo): void;

    public function findAllByUserId(Uuid $userId): array;
}
