<?php

namespace App\Models;

use App\Core\Model;

class Reservation extends Model
{
    protected ?int $id = null;
    protected int $bookItemId;
    protected ?int $customerId = null;
    protected ?string $borrowed = null;

    public static function getAvailableBooks($bookItemId) : array
    {
        return self::getAll('`bookItemId` = ? AND `customerId` IS NULL', [$bookItemId]);
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBookItemId(): int
    {
        return $this->bookItemId;
    }

    public function setBookItemId(int $bookItemId): void
    {
        $this->bookItemId = $bookItemId;
    }

    public function getCustomerId(): ?int
    {
        return $this->customerId;
    }

    public function setCustomerId(?int $customerId): void
    {
        $this->customerId = $customerId;
    }

    public function getBorrowed(): ?string
    {
        return $this->borrowed;
    }

    public function setBorrowed(?string $borrowed): void
    {
        $this->borrowed = $borrowed;
    }

}