<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Helpers\PetsLoader;
use App\Models\Pet;

class PetController extends AControllerBase
{
    /**
     *
     * @return Response
     */
    public function index(): Response
    {
        PetsLoader::loadPets("data/pets.csv");
        $pets = Pet::getAll();
        return $this->html(['pets' => $pets]);
    }
    public function pet(): Response
    {
        return $this->html();
    }
    public function create()
    {
    }

    public function read($petId)
    {
        $pet = Pet::find($petId);
    }


    public function update($petId)
    {
        $pet = Pet::find($petId);
        $pet->setName($_POST['name']);
        $pet->setType($_POST['type']);
        $pet->setAge($_POST['age']);
        $pet->save();
    }

    public function delete($petId)
    {
        $pet = Pet::find($petId);
        $pet->delete();
    }
}