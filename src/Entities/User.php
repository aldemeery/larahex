<?php

namespace Larahex\Entities;

use Symfony\Component\Uid\Uuid;

class User
{
    public function __construct(
        private Uuid $id,
        private string $name,
        private string $email,
        private string $password,
    ) {
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
