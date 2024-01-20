<?php

namespace App\Models;

use App\Core\Model;

class ProductDescription extends Model
{
    protected ?int $id = null;
    protected ?int $productId = null;
    protected ?string $description = "";

    public function __construct(
        ?int $productId = null,
        ?string $description = ""
    ) {
        $this->productId = $productId;
        $this->description = $description;
    }

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

}