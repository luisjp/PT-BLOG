<?php

namespace App\Blog\Domain\Model;
/**
 * Class User
 * 
 * user information
 * 
 */
final class User {

    public $id;

    public string $name;

    public string $email;

    public string $password;

    public function __construct(
        int $id,
        string $name,
        string $email)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id): void{
        $this->id = $id;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function setName(string $name): void{
        $this->name = $name;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function setEmail(string $email): void{
        $this->email = $email;
    }
}   