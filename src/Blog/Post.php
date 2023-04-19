<?php

namespace Blog\Defox\Blog;

class Post
{
    private int $id;
    private User $user;
    private string $text;

    public function __construct(int $id, User $user, string $text)
    {
        $this->id = $id;
        $this->user = $user;
        $this->text = $text;
    }

    public function __toString(): string
    {
        return "Пользователь $this->user оставил пост: $this->text, id:$this->id";
    }
}