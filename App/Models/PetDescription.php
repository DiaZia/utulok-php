<?php

namespace App\Models;

use App\Core\Model;

class PetDescription extends Model
{
    protected ?int $id = null;
    protected ?int $petId = null;
    protected ?string $description = "";


    public function __construct(
        ?int $petId = null,
        ?string $description = ""
    ) {
        $this->petId = $petId;
        $this->description = $description;
    }

    public function getPetId(): ?int
    {
        return $this->petId;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }
}