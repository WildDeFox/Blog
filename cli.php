<?php

use Blog\Defox\Blog\Post;
use Blog\Defox\Blog\Repositories\PostsRepository\SqlitePostsRepository;
use Blog\Defox\Blog\Repositories\UserRepository\SqliteUsersRepository;
use Blog\Defox\Blog\UUID;


include __DIR__ . '/vendor/autoload.php';
$connection = new PDO('sqlite:' . __DIR__ . '/blog.sqlite');
$userRepository = new SqliteUsersRepository($connection);
$postRepository = new SqlitePostsRepository($connection);


try {
    $user = $userRepository->getByUsername('Admin');
    $post = $postRepository->get(new UUID('46816538-83ba-4d30-a76d-f30b146b02ca'));
    echo $user;
    echo $post;
} catch (Exception $e) {
    echo $e->getMessage();
}

// $post = new Post(UUID::random(), $user, 'Первый пост','Привет мир! Это мой первый пост');
// $postRepository->save($post);
