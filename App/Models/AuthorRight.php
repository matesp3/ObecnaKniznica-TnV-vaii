<?php

namespace App\Models;

use App\Core\Model;

class AuthorRight extends Model
{
    protected ?int $id = null;
    protected int $authorId;
    protected int $bookItemId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuthorId(): int
    {
        return $this->authorId;
    }

    public function setAuthorId(int $authorId): void
    {
        $this->authorId = $authorId;
    }

    public function getBookItemId(): int
    {
        return $this->bookItemId;
    }

    public function setBookItemId(int $bookItemId): void
    {
        $this->bookItemId = $bookItemId;
    }


}