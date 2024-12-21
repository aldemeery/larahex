<?php

namespace App\Repositories;

use App\Models\Todo as TodoModel;
use Larahex\Contracts\TodoRepository as TodoRepositoryContract;
use Larahex\Entities\Todo;
use Larahex\Entities\User;
use Symfony\Component\Uid\Uuid;

class TodoRepository implements TodoRepositoryContract
{
    public function find(Uuid $id): Todo
    {
        $todo = TodoModel::with('user')->findOrFail($id->toString());

        return new Todo(
            id: $id,
            user: new User(
                id: Uuid::fromString($todo->user->id),
                name: $todo->user->name,
                email: $todo->user->email,
                password: $todo->user->password,
            ),
            title: $todo->title,
            description: $todo->description,
            completed: $todo->completed,
        );
    }

    public function persist(Todo $todo): void
    {
        $todoModel = new TodoModel();
        $todoModel->id = $todo->getId()->toString();
        $todoModel->user_id = $todo->getUser()->getId()->toString();
        $todoModel->title = $todo->getTitle();
        $todoModel->description = $todo->getDescription();
        $todoModel->completed = $todo->isCompleted();
        $todoModel->exists = TodoModel::where('id', $todo->getId()->toString())->exists();

        $todoModel->save();
    }

    public function findAllByUserId(Uuid $userId): array
    {
        $todos = TodoModel::where('user_id', $userId->toString())->get();

        return $todos->map(function ($todo) {
            return new Todo(
                id: Uuid::fromString($todo->id),
                user: new User(
                    id: Uuid::fromString($todo->user->id),
                    name: $todo->user->name,
                    email: $todo->user->email,
                    password: $todo->user->password,
                ),
                title: $todo->title,
                description: $todo->description,
                completed: $todo->completed,
            );
        })->all();
    }
}
