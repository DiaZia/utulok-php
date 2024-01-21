<?php

namespace App\Models;

use App\Core\Model;

class Product_Order extends Model
{
    protected ?int $id = null;
    protected ?int $productId;
    protected ?int $orderId;
    protected ?int $quantity;

    /**
     * @param int|null $id
     * @param int|null $productId
     * @param int|null $orderId
     * @param int|null $quantity
     */
    public function __construct(?int $id = null, ?int $productId = null, ?int $orderId = null, ?int $quantity = null)
    {
        $this->id = $id;
        $this->productId = $productId;
        $this->orderId = $orderId;
        $this->quantity = $quantity;
    }


}