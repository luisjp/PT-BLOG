<?php

namespace App\Blog\Domain\Repository;

use App\Blog\Domain\Model\Post;
use Illuminate\Support\Collection;

/**
 * Interface PostExternalRepositoryInterface
 * @package App\Blog\Infrastructure\Repositories
 */
interface PostExternalRepositoryInterface
{
    public function createPost(string $title, string $body, $userId = 1): Post;

    /**
     * @param $id
     * @return mixed
     */
    public function findPost($id): Post;

    /**
     * @return mixed
     */
    public function findAll(): array;

}