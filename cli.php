<?php

use Blog\Defox\Blog\Repositories\UserRepository\SqliteUsersRepository;
use Blog\Defox\Blog\User;
use Blog\Defox\Blog\UUID;
use Blog\Defox\Person\Name;


include __DIR__ . '/vendor/autoload.php';
$connection = new PDO('sqlite:' . __DIR__ . '/blog.sqlite');
$userRepository = new SqliteUsersRepository($connection);

$name = new Name('Никита', 'Капурин');


try {
    $user = new User(UUID::random(), $name, 'Admin');
    $userRepository->save($user);
} catch (Exception $e) {
    echo $e->getMessage();
}


