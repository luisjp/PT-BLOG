<?php

namespace App\Blog\Infrastructure\Translator;

use App\Blog\Domain\Exception\InvalidDomainException;
use App\Blog\Domain\Model\Post;
use App\Blog\Infrastructure\Eloquent\Post as PostEloquent;

/**
 * Class PostTranslator
 * @package App\Blog\Infrastructure\Translator
 */
class PostTranslator
{
    public static function toModel(PostEloquent $eloquent): Post
    {
        try {
            $post = new Post(
                $eloquent->id,
                $eloquent->title,
                $eloquent->body,
                $eloquent->updated_at,
                $eloquent->user_id
            );

            $post->setUser($eloquent->user);
        
            return $post;
        } catch (InvalidDomainException $e) {
            // Swallow the exception to continue
        }
    }

    public static function externalToModel($object): Post
    {
        try {
            $post = new Post(
                $object->id,
                $object->title,
                $object->body,
                (!isset($object->updated_at)) ? '2022-07-21' : $object->updated_at,
                $object->userId
            );

            return $post;
        } catch (InvalidDomainException $e) {
            // Swallow the exception to continue
        }
    }

}