<?php

namespace App\Models;

use App\Core\Model;
use Cassandra\Date;

class Adoption extends Model
{
    protected ?int $id = null;
    protected ?int $userId = null;
    protected ?int $petId = null;
    protected ?string $dateFrom;

    /**
     * @param $userId
     * @param $petId
     * @param $dateFrom
     */
    public function __construct(
        ?int $id = null,
        ?int $userId = null,
        ?int $petId = null,
        ?string $dateFrom = null
    ) {
        $this->id = $id;
        $this->userId = $userId;
        $this->petId = $petId;
        $this->dateFrom = $dateFrom;
    }

    public function getPetId(): ?int
    {
        return $this->petId;
    }

    public function getDate(): ?string
    {
        return $this->dateFrom;
    }

}