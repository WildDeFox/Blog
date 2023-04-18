<?php

namespace Blog\Defox\Person;

use DateTimeImmutable;

class Person
{
    private DateTimeImmutable $registeredOn;
    private Name $name;

    public function __construct(Name $name, DateTimeImmutable $registeredOn)
    {
        $this->name = $name;
        $this->registeredOn = $registeredOn;
    }

    public function __toString(): string
    {
        return $this->name . ' на сайте с (' . $this->registeredOn->format('Y-m-d') . ')';
    }
}