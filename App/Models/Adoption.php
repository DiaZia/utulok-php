<?php

namespace App\Models;

use App\Core\Model;

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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPetId(): ?int
    {
        return $this->petId;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function getDate(): ?string
    {
        return $this->dateFrom;
    }

    public static function getOne($id): ?static
    {
        $result = parent::getOne($id);
        if (is_array($result)) {
            $adoption = new Adoption();
            foreach ($result as $key => $value) {
                $adoption->{$key} = $value;
            }

            return $adoption;
        }
        return null;
    }

}
