<?php

namespace Blog\Defox\Blog;

use Blog\Defox\Exceptions\InvalidArgumentExceptions;

class UUID
{
    private string $uuidString;

    /**
     * @throws InvalidArgumentExceptions
     */
    public function __construct(string $uuidString)
    {
        $this->uuidString = $uuidString;

        if (!uuid_is_valid($uuidString)) {
            throw new InvalidArgumentExceptions(
                "Malformed UUID: $this->uuidString"
            );
        }
    }

    /**
     * @throws InvalidArgumentExceptions
     */
    public static function random(): self
    {
        return new self(uuid_create(UUID_TYPE_RANDOM));
    }

    public function __toString(): string
    {
        return $this->uuidString;
    }
}