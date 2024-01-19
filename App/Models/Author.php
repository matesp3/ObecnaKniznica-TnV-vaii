<?php

namespace App\Models;

use App\Core\Model;
use http\Exception\InvalidArgumentException;

class Author extends Model
{
    protected ?int $id = null;

    protected string $name;
    protected string $surname;
    protected string $created = "not defined";

    public static function getAuthor(string $name, string $surname) : ?Author
    {
        if (strlen($name) == 0 || strlen($surname) == 0)
            throw new InvalidArgumentException("Name or surname is empty!", 500);
        $fetchResult = Self::getAll('`name` LIKE ? AND `surname` LIKE ?', [$name, $surname]);

        return (count($fetchResult) > 0) ? $fetchResult[0] : null;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    public function getCreated(): string
    {
        return $this->created;
    }

    public function setCreated(string $created): void
    {
        $this->created = $created;
    }
}