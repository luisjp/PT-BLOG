<?php

namespace App\Blog\Domain\Repository;

use App\Blog\Domain\Model\User;
use Illuminate\Support\Collection;

/**
 * Interface UserRepositoryInterface
 * @package App\Blog\Infrastructure\Repositories
 */
interface UserRepositoryInterface
{
    /**
     * @param $id
     * @return mixed
     */
    public function findUser($id): User;

    /**
     * @return mixed
     */
    public function findAll(): Collection;
}