<?php

namespace App\Models;

class User
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
    public function __construct($username, $email, $password)
    {
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
        return $this->name;
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