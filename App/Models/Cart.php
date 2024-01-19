<?php

namespace App\Models;

use App\Core\Model;

class Cart extends Model
{
    protected ?int $id = null;
    protected ?int $userId;
    protected ?int $productId;
    protected ?int $quantity;

    /**
     * @param int|null $id
     * @param int|null $userId
     * @param int|null $productId
     * @param int|null $quantity
     */
    public function __construct(
        ?int $id = null,
        ?int $userId = null,
        ?int $productId = null,
        ?int $quantity = null)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->productId = $productId;
        $this->quantity = $quantity;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function plusQuantity($plus): void
    {
        $this->quantity += $plus;
    }


}