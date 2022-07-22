<?php 

namespace App\Blog\Application\Posts;

use App\Blog\Domain\Repository\PostExternalRepositoryInterface;

class PostsExternal {

    private PostExternalRepositoryInterface $repository;

    public function __construct(PostExternalRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function findAllPosts() {
        return $this->repository->findAll();
    }

    public function findPost ($id)
    {
        return $this->repository->findPost($id);
    }

    public function createPost(
        string $title, 
        string $body, 
        $userId = 1
    ) {

        return $this->repository->createPost($title, $body, $userId);
    }
}