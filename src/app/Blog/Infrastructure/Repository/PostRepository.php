<?php

namespace App\Blog\Infrastructure\Repository;

use App\Blog\Domain\Model\Post;
use App\Blog\Domain\Repository\PostRepositoryInterface;
use App\Blog\Infrastructure\Eloquent\Post as PostEloquent;
use App\Blog\Infrastructure\Translator\PostTranslator;
use Illuminate\Support\Collection;

/**
 * Class PostRepository
 * @package App\Blog\Infrastructure\Repositories
 */
class PostRepository implements PostRepositoryInterface
{
    /** @var PostEloquent */
    private $model;

     /**
     * PostRepository constructor.
     * @param PostEloquent $post
     */
    public function __construct()
    {
        $this->model = new PostEloquent();
    }

    public function createPost(
        string $title, 
        string $body, 
        $userId = 1): Post 
    {
        $newPost = $this->model->createPost($title, $body, $userId);
        if (empty($newPost)) {
            // TODO:: Error Handling
        }
        
        $post = $newPost->fresh();
        return PostTranslator::toModel($post);
    }

    /**
     * Get Post
     * @param $id
     * @return Post
     */
    public function findPost($id): Post
    {
        $post = $this->model->findPost($id);
        if (empty($post)) {
            // TODO:: Error Handling
        }
        
        return PostTranslator::toModel($post);
    }

    /**
     * Get Post List
     * @return Collection
     */
    public function findAll(): Collection
    {
        $collection = $this->model->allPost();

        return $collection->map(function (PostEloquent $post) {
            return PostTranslator::toModel($post);
        });
    }
}