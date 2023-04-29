<?php
namespace Blog\Defox\Repositories\UserRepository;
use Blog\Defox\Blog\User;
use Blog\Defox\Blog\UUID;


interface UsersRepositoryInterface
{
    public function save(User $user): void;
    public function get(UUID $uuid): User;
    public function getByUsername(string $username): User;
}