<?php

namespace App\Models;

use App\Core\Model;

class Pet extends Model
{
    protected ?int $id = null;
    protected ?string $name;
    protected ?string $type;
    protected ?string $imagePath;
    protected ?int $age;

    /**
     * @param $name
     * @param $type
     * @param $imagePath
     * @param $age
     */
    public function __construct($name, $type, $imagePath, $age)
    {
        $this->name = $name;
        $this->type = $type;
        $this->imagePath = $imagePath;
        $this->age = $age;
    }
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    public function setImagePath(string $path): void
    {
        $this->imagePath = $path;
    }
    public function getAge(): ?int
     {
         return $this->age;
     }

    public function setAge(int $age): void
    {
        $this->age = $age;
    }
}