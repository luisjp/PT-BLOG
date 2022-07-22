<?php

namespace App\Blog\Domain\Model;
/**
 * Class User
 * 
 * user information
 * 
 */
final class User {

    private $id;

    private string $name;

    private string $email;

    private string $password;

    public function __construct(
        int $id,
        string $name,
        string $email)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function email(): Email
    {
        return $this->email;
    }
}   