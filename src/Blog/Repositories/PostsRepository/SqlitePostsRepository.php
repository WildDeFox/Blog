<?php

namespace Blog\Defox\Blog\Repositories\PostsRepository;

use Blog\Defox\Blog\Post;
use Blog\Defox\Blog\Repositories\UserRepository\SqliteUsersRepository;
use Blog\Defox\Blog\UUID;
use Blog\Defox\Exceptions\InvalidArgumentExceptions;
use Blog\Defox\Exceptions\PostNotFoundExceptions;
use Blog\Defox\Exceptions\UserNotFoundException;
use PDO;
use PDOStatement;

class SqlitePostsRepository implements PostsRepositoryInterface
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Post $post): void
    {
        $statement = $this->connection->prepare(
            'INSERT INTO posts (uuid, author_uuid, title, text)
                   VALUES (:uuid, :author_uuid, :title, :text)'
        );

        $statement->execute([
            ':uuid' => $post->getUuid(),
            ':author_uuid' => $post->getUser()->getUuid(),
            ':title' => $post->getTitle(),
            ':text' => $post->getText()
        ]);
    }

    /**
     * @throws InvalidArgumentExceptions
     * @throws PostNotFoundExceptions
     * @throws UserNotFoundException
     */
    public function get(UUID $uuid): Post
    {
        $statement = $this->connection->prepare(
            'SELECT * FROM posts WHERE uuid = :uuid'
        );

        $statement->execute([
            ':uuid' => (string)$uuid,
        ]);

        return $this->getPost($statement, $uuid);
    }

    /**
     * @throws PostNotFoundExceptions
     * @throws InvalidArgumentExceptions|UserNotFoundException
     */
    private function getPost(PDOStatement $statement, string $postUuId): Post
    {
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if($result === false) {
            throw new PostNotFoundExceptions(
                "Cannot find post: $postUuId"
            );
        }

        $userRepository = new SqliteUsersRepository($this->connection);
        $user = $userRepository->get(new UUID($result['author_uuid']));

        return new Post(
            new UUID($result['uuid']),
            $user,
            $result['title'],
            $result['text']
        );
    }
}