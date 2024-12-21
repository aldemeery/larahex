<?php

namespace Larahex\Contracts;

use Larahex\Entities\Todo;
use Symfony\Component\Uid\Uuid;

interface TodoService
{
    public function create(Uuid $userId, string $title, string $description = '', bool $completed = false): Todo;

    public function list(Uuid $userId): array;

    public function complete(Uuid $id): Todo;
}
