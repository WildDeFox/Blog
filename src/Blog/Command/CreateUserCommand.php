<?php

namespace Blog\Defox\Blog\Command;

use Blog\Defox\Blog\User;
use Blog\Defox\Blog\UUID;
use Blog\Defox\Exceptions\ArgumentsException;
use Blog\Defox\Exceptions\CommandException;
use Blog\Defox\Exceptions\InvalidArgumentExceptions;
use Blog\Defox\Exceptions\UserNotFoundException;
use Blog\Defox\Person\Name;
use Blog\Defox\Repositories\UserRepository\UsersRepositoryInterface;

class CreateUserCommand
{
    private UsersRepositoryInterface $usersRepository;

    public function __construct(UsersRepositoryInterface $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    /**
     * @throws ArgumentsException
     * @throws CommandException
     * @throws InvalidArgumentExceptions
     */
    public function handle(Arguments $arguments): void
    {
        $username = $arguments->get('username');

        if ($this->userExists($username)) {
            throw new CommandException(
                "User already exists: $username"
            );
        }

        $this->usersRepository->save(new User(
            UUID::random(),
            new Name(
                $arguments->get('first_name'),
                $arguments->get('last_name'),
            ),
            $username,
        ));
    }

    private function userExists(string $username): bool
    {
        try {
            $this->usersRepository->getByUsername($username);
        } catch (UserNotFoundException) {
            return false;
        }
        return true;
    }

}