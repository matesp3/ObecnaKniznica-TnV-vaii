<?php

namespace App\Models;

use App\Core\Model;

class User extends Model
{
    protected ?int $id = null;
    protected string $login;
    protected string $passwordHash;
    protected string $realName;
    protected string $realSurname;
    protected string $role;
    protected string $created;

    public static function getUserByLogin(string $login) : ?User
    {
        $wanted = self::getAll('`login` LIKE ?', [$login]);
        return (count($wanted) == 1) ? $wanted[0] : null;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    public function setPasswordHash(string $passwordHash): void
    {
        $this->passwordHash = $passwordHash;
    }

    public function getRealName(): string
    {
        return $this->realName;
    }

    public function setRealName(string $realName): void
    {
        $this->realName = $realName;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    public function getRealSurname(): string
    {
        return $this->realSurname;
    }

    public function setRealSurname(string $realSurname): void
    {
        $this->realSurname = $realSurname;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): void
    {
        $this->role = $role;
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