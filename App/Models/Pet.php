<?php

namespace App\Models;

use App\Core\Model;

class Pet extends Model
{
    protected ?int $id = null;
    protected ?string $name;
    protected ?string $type;
    protected ?int $age;
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getType(string $type): ?string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getAge(int $age): ?int
     {
         return $this->age;
     }

    public function setAge(int $age): void
    {
        $this->age = $age;
    }
}