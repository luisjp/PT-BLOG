<?php

namespace App\Blog\Infrastructure\Translator;

use App\Blog\Domain\Exception\InvalidDomainException;
use App\Blog\Domain\Model\User;
use App\Blog\Infrastructure\Eloquent\UserEloquent;

/**
 * Class UserTranslator
 * @package App\Blog\Infrastructure\Translator
 */
class UserTranslator
{
    public static function toModel(UserEloquent $eloquent): User
    {
        try {
            return new User(
                $eloquent->id,
                $eloquent->name,
                $eloquent->email,
                $eloquent->password
            );
        } catch (InvalidDomainException $e) {
            // Swallow the exception to continue
        }
    }
}