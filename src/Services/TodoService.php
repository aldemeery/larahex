<?php

namespace Larahex\Services;

use Larahex\Contracts\TodoRepository;
use Larahex\Contracts\TodoService as TodoServiceContract;
use Larahex\Contracts\UserRepository;
use Larahex\Entities\Todo;
use Symfony\Component\Uid\Uuid;
use Psl\Type;

class TodoService implements TodoServiceContract
{
    public function __construct(
        private TodoRepository $todos,
        private UserRepository $users,
    ) {
    }

    public function create(Uuid $userId, string $title, string $description = '', bool $completed = false): Todo
    {
        $user = $this->users->find($userId);

        $todo = new Todo(
            id: Uuid::v4(),
            user: $user,
            title: $title,
            description: $description,
            completed: $completed,
        );

        $this->todos->persist($todo);

        return $todo;
    }

    public function list(Uuid $userId): array
    {
        return Type\vec(Type\instance_of(Todo::class))->assert($this->todos->findAllByUserId($userId));
    }

    public function complete(Uuid $id): Todo
    {
        $todo = $this->todos->find($id);

        $todo->complete();

        $this->todos->persist($todo);

        return $todo;
    }
}
