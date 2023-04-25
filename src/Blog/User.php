<?php

namespace Blog\Defox\Blog;

use Blog\Defox\Person\Name;

class User
{
    private int $id;
    private Name $name;

    public function __construct(int $id, Name $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @return Name
     */
    public function getName(): Name
    {
        return $this->name;
    }

    /**
     * @param Name $name
     */
    public function setName(Name $name): void
    {
        $this->name = $name;
    }



    public function __toString(): string
    {
        return "Пользователь $this->name с id:$this->id";
    }

    public function getId(): string
    {
        return $this->id;
    }
}