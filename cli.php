<?php

use Blog\Defox\Blog\Post;
use Blog\Defox\Blog\User;
use Blog\Defox\Person\Name;

include __DIR__ . '/vendor/autoload.php';

$name = new Name('Никита', 'Капурин');
$user = new User(1, $name);
$post = new Post(2, $user, 'Привет мир, это мой первый пост');

