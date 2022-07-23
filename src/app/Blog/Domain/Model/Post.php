<?php

namespace App\Blog\Domain\Model;

use App\Blog\Infrastructure\Eloquent\User;

class Post {

    public $id;
    public string $title;
    public string $body;
    public string $user_id;
    public string $updated_at;
    public User $user;

    public function __construct(
        int $id,
        string $title,
        string $body,
        string $updated_at,
        string $user_id)
    {
        $this->id = $id;
        $this->title = $title;
        $this->body = $body;
        $this->updated_at = $updated_at;
        $this->user_id = $user_id;

        $this->user = new User();
    }

    public function setUser(User $user): void{
        $this->user = $user;
    }

    public function getUser() : User
    {
        return $this->user;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    public function getBody(): string
    {
        return $this->body;
    }
    
    public function getUserId(): string
    {
        return $this->user_id;
    }
    
    public function setId($id): void{
        $this->id = $id;
    }

    public function setTitle($title): void{
        $this->title = $title;
    }

    public function setBody($body): void{
        $this->body = $body;
    }

    public function setUpdateAt($updated_at): void{
        $this->updated_at = $updated_at;
    }

    public function getMapValue(){
        return array(
            'id' => $this->getId(), 
            'body' => $this->getBody(), 
            'title' => $this->getTitle(),
            'userId' => $this->getUserId()
        );
    }
}   