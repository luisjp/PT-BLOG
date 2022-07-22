<?php

namespace App\Blog\Application\UseCase;

use App\Blog\Domain\Repository\UserRepositoryInterface;

/**
 * Class User
 * @package App\Blog\Application\UseCase
 */
class User
{

    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function find($id)
    {
        return $this->userRepository->find($id);
    }

    public function findAll()
    {
        return $this->userRepository->findAll();
    }
}