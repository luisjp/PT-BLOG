<?php

namespace App\Blog\Domain\Model;

use App\Blog\Infrastructure\Eloquent\User;

class Post {

    private $id;
    private string $title;
    private string $body;
    private string $user_id;
    private string $updated_at;
    private User $user;

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

    public function id(): int
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function updated_at(): string
    {
        return $this->updated_at;
    }

    public function body(): string
    {
        return $this->body;
    }
    
    public function user_id(): string
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
            'id' => $this->id(), 
            'body' => $this->body(), 
            'title' => $this->title(),
            'userId' => $this->user_id()
        );
    }
}   