<?php

namespace App\Models;

use App\Core\Model;

class UsersOrder extends Model
{
    protected ?int $id = null;
    protected ?int $userId;
    protected ?float $totalPrice;

    /**
     * @param int|null $id
     * @param int|null $userId
     * @param float|null $totalPrice
     */
    public function __construct(?int $id = null, ?int $userId = null, ?float $totalPrice = null)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->totalPrice = $totalPrice;
    }

    public function getId(): ?int
    {
        return $this->id;
    }


}