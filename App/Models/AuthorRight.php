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

    public static function getAuthorRight(string $authorId, string $bookId) : array
    {
        return self::getAll('`authorId` = ? AND `bookItemId` = ?', [$authorId, $bookId]);
    }
    public static function getAllAuthorRightsWithBookId(int $bookId) : array
    {
        return self::getAll('`bookItemId` = ?', [$bookId]);
    }

    public static function deleteAuthorRight(string $authorId, string $bookId) : void
    {
        self::getAuthorRight($authorId, $bookId)?->delete();
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