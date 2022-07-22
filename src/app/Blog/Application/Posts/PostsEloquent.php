<?php 

namespace App\Blog\Application\Posts;

use App\Blog\Domain\Repository\PostRepositoryInterface;

class PostsEloquent {

    private PostRepositoryInterface $repository;

    public function __construct(PostRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function findAllPosts() {
        return $this->repository->findAll();
    }

    public function createPosts(
        string $title, 
        string $body, 
        $userId = 1
    ): Post {
        return $this->repository->createPost($title, $body, $userId);
    }

    public function findPost ($id)
    {
        return $this->repository->findPost($id);
    }

    public function createPost(
        string $title, 
        string $body, $userId = 1) {

        return $this->repository->createPost($title, $body, $userId);
    }
}