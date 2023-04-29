<?php

namespace Blog\Defox\Repositories\PostsRepository;

use Blog\Defox\Blog\Post;
use Blog\Defox\Blog\UUID;

interface PostsRepositoryInterface
{
    public function save(Post $post): void;
    public function get(UUID $uuid): Post;
}