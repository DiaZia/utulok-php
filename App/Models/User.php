<?php

namespace App\Models;

use App\Core\Model;

class User extends Model
{
    protected ?int $id = null;
    protected ?string $username;
    protected ?string $email;
    protected ?string $password;

    /**
     * @param $username
     * @param $email
     * @param $password
     */
    public function __construct(
        ?int $id = null,
        ?string $username = null,
        ?string $email = null,
        ?string $password = null)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }


    public function getId(): ?int
    {
        return $this->id;
    }
    public function getUsername(): ?string
    {
        return $this->username;
    }


    public function setUsername($username): void
    {
        $this->username = $username;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }


    public function getPassword(): ?string
    {
        return $this->password;
    }


    public function setPassword($password): void
    {
        $this->password = $password;
    }
}