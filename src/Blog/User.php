<?php

namespace Blog\Defox\Blog;

use Blog\Defox\Person\Name;

class User
{
    private UUID $uuid;
    private Name $name;
    private string $username;

    public function __construct(UUID $uuid, Name $name, string $username)
    {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->username = $username;
    }

    /**
     * @return UUID
     */
    public function getUuid(): UUID
    {
        return $this->uuid;
    }

    /**
     * @param UUID $uuid
     */
    public function setUuid(UUID $uuid): void
    {
        $this->uuid = $uuid;
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

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function __toString(): string
    {
        return "Пользователь $this->name с uuid:$this->uuid";
    }
}