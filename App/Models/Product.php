<?php

namespace App\Models;

use App\Core\Model;


class Product extends Model
{

    protected ?int $id = null;
    protected ?int $petId;
    protected ?string $name;
    protected ?float $price;
    protected ?string $imagePath;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPetId(): ?int
    {
        return $this->petId;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }


}