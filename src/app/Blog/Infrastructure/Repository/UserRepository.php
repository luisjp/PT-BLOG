<?php

namespace App\Blog\Infrastructure\Repository;

use App\Blog\Domain\Model\User;
use App\Blog\Domain\Repository\UserRepositoryInterface;
use App\Blog\Infrastructure\Eloquent\User as UserEloquent;
use App\Blog\Infrastructure\Translator\UserTranslator;
use Illuminate\Support\Collection;

/**
 * Class UserRepository
 * @package App\Blog\Infrastructure\Repositories
 */
class UserRepository implements UserRepositoryInterface
{
    /** @var UserEloquent */
    private $eloquent;

     /**
     * UserRepository constructor.
     * @param UserEloquent $user
     */
    public function __construct()
    {
        $this->eloquent = new UserEloquent();
    }

    /**
     * Get User
     * @param $id
     * @return User
     */
    public function findUser($id): User
    {
        $eloquent = $this->eloquent->find($id);
        if (empty($eloquent)) {
            // TODO:: Error Handling
        }
        return UserTranslator::toModel($eloquent);
    }

    /**
     * Get User List
     * @return Collection
     */
    public function findAll(): Collection
    {
        $collection = $this->eloquent->all();
        return $collection->map(function (UserEloquent $eloquent) {
            return UserTranslator::toModel($eloquent);
        });
    }
}