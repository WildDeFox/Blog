<?php

namespace Blog\Defox\Blog\Repositories\UserRepository;

use Blog\Defox\Blog\User;
use Blog\Defox\Blog\UUID;
use Blog\Defox\Exceptions\InvalidArgumentExceptions;
use Blog\Defox\Exceptions\UserNotFoundException;
use Blog\Defox\Person\Name;
use PDO;
use PDOStatement;

class SqliteUsersRepository implements UsersRepositoryInterface
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(User $user): void
    {
        $statement = $this->connection->prepare(
            'INSERT INTO users (uuid, first_name, last_name, username)
                   VALUES (:uuid, :first_name, :last_name, :username)'
        );

        $statement->execute([
            ':uuid' => $user->getUuid(),
            ':first_name' => $user->getName()->getFirstName(),
            ':last_name' =>$user->getName()->getLastName(),
            ':username' => $user->getUsername()
        ]);
    }

    /**
     * @throws InvalidArgumentExceptions
     * @throws UserNotFoundException
     */
    public function get(UUID $uuid): User
    {
        $statement = $this->connection->prepare(
            'SELECT * FROM users WHERE uuid = :uuid'
        );

        $statement->execute([
            ':uuid' => $uuid
        ]);

        return $this->getUser($statement, $uuid);
    }

    /**
     * @throws InvalidArgumentExceptions
     * @throws UserNotFoundException
     */
    public function getByUsername(string $username): User
    {
        $statement = $this->connection->prepare(
            'SELECT * FROM users WHERE username = :username'
        );

        $statement->execute([
            ':username' => $username
        ]);

        return $this->getUser($statement, $username);
    }

    /**
     * @throws InvalidArgumentExceptions
     * @throws UserNotFoundException
     */
    public function getUser(PDOStatement $statement, string $username): User
    {
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if ($result === false) {
            throw new UserNotFoundException(
                "Cannot find user: $username"
            );
        }

        return new User(
            new UUID($result['uuid']),
            new Name($result['first_name'], $result['last_name']),
            $result['username']
        );
    }

}