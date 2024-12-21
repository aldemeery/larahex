<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Larahex\Contracts\TodoService;
use Laravel\Prompts as P;
use Symfony\Component\Uid\Uuid;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command(
    'todo:create {userId} {title} {description?}',
    function (
        TodoService $todos,
        string $userId,
        string $title,
        string $description = '',
    ): int {
        $userId = Uuid::fromString($userId);

        $todo = $todos->create($userId, $title, $description);

        P\table(
            ['ID', 'Title', 'Description', 'Completed', 'User'],
            [[
                $todo->getId()->toString(),
                $todo->getTitle(),
                $todo->getDescription(),
                $todo->isCompleted() ? 'Yes' : 'No',
                $todo->getUser()->getName(),
            ]],
        );

        return 0;
    },
)->purpose('Create a new todo item');


Artisan::command(
    'todo:list {userId}',
    function (
        TodoService $todos,
        string $userId,
    ): int {
        $userId = Uuid::fromString($userId);

        $todos = $todos->list($userId);

        P\table(
            ['ID', 'Title', 'Description', 'Completed', 'User'],
            array_map(
                fn ($todo) => [
                    $todo->getId()->toString(),
                    $todo->getTitle(),
                    $todo->getDescription(),
                    $todo->isCompleted() ? 'Yes' : 'No',
                    $todo->getUser()->getName(),
                ],
                $todos,
            ),
        );

        return 0;
    },
)->purpose('List all todo items for a user');

Artisan::command(
    'todo:complete {todoId}',
    function (
        TodoService $todos,
        string $todoId,
    ): int {
        $todoId = Uuid::fromString($todoId);

        $todo = $todos->complete($todoId);

        P\table(
            ['ID', 'Title', 'Description', 'Completed', 'User'],
            [[
                $todo->getId()->toString(),
                $todo->getTitle(),
                $todo->getDescription(),
                $todo->isCompleted() ? 'Yes' : 'No',
                $todo->getUser()->getName(),
            ]],
        );

        return 0;
    },
)->purpose('Mark a todo item as completed');
