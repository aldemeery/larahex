<?php

namespace Larahex\Entities;

use Larahex\Entities\User;
use Symfony\Component\Uid\Uuid;

class Todo
{
    public function __construct(
        private Uuid $id,
        private User $user,
        private string $title,
        private string $description,
        private bool $completed = false,
    ) {
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function isCompleted(): bool
    {
        return $this->completed;
    }

    public function complete(): void
    {
        $this->completed = true;
    }
}
