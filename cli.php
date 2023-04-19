<?php

use Blog\Defox\Blog\User;
use Blog\Defox\Person\Name;

include __DIR__ . '/vendor/autoload.php';

$name = new Name('Никита', 'Капурин');
$user = new User(1, $name);
echo $user;
echo $name;
