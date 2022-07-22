<?php

namespace App\Blog\Application\UseCase;

use App\Blog\Domain\Repository\PostRepositoryInterface;

/**
 * Class Post
 * @package App\Blog\Application\UseCase
 */
class Post
{

    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function find($id)
    {
        return $this->postRepository->find($id);
    }

    public function findAll()
    {
        return $this->postRepository->findAll();
    }
}