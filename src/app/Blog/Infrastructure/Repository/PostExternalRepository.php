<?php

namespace App\Blog\Infrastructure\Repository;

use App\Blog\Domain\Model\Post;
use App\Blog\Domain\Repository\PostExternalRepositoryInterface;
use App\Blog\Infrastructure\JsonDataSource\PostDataExternal as PostData;
use App\Blog\Infrastructure\Translator\PostTranslator;
use App\Blog\Infrastructure\Tools\CheckRequestFromInputs;
use Illuminate\Support\Collection;

/**
 * Class PostRepository
 * @package App\Blog\Infrastructure\Repositories
 */
class PostExternalRepository implements PostExternalRepositoryInterface
{
    /** @var PostData */
    private $model;

     /**
     * PostRepository constructor.
     * @param PostData $post
     */
    public function __construct()
    {
        $this->model = new PostData();
    }

    public function createPost(
        string $title = "",
        string $body  = "", 
        $userId = 1
    ): Post 
    {
        $title = CheckRequestFromInputs::parseString($title);
        $body = CheckRequestFromInputs::parseString($body);
        
        $post = new Post(0, $title, $body, '2022-07-22', $userId);

        $newPost = $this->model->createPost($post);
        if (empty($newPost)) {
            return new Post(0, null, null, null, 0);
        }
        
        return PostTranslator::externalToModel($newPost);
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
            return new Post(0, null, null, null, 0);
        }
        
        return PostTranslator::externalToModel($post);
    }

    /**
     * Get Post List
     * @return array
     */
    public function findAll(): array
    {
        $collection = $this->model->allPost();
        $listPosts = [];

        foreach ($collection as $post) {
            $postParsed = PostTranslator::externalToModel($post);
            $listPosts[] = $postParsed;
        }

        return $listPosts;
    }
}