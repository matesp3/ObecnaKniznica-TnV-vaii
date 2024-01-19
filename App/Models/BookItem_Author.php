<?php

namespace App\Models;

use App\Core\Model;

class BookItem_Author extends Model
{
    protected ?int $id = null;
    protected int $author_id;
    protected int $bookitem_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuthorId(): int
    {
        return $this->author_id;
    }

    public function setAuthorId(int $author_id): void
    {
        $this->author_id = $author_id;
    }

    public function getBookitemId(): int
    {
        return $this->bookitem_id;
    }

    public function setBookitemId(int $bookitem_id): void
    {
        $this->bookitem_id = $bookitem_id;
    }


}