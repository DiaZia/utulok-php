<?php

namespace App\Helpers;

use App\Models\Pet;
class PetsLoader
{
    /**
     * Static method for loading persons from a file
     * @param $filePath
     * @return \App\Models\Pet[]
     */
    public static function loadPets($filePath)
    {
        $pets = [];
        $wholeFile = file_get_contents($filePath);
        $allLines = explode(PHP_EOL, $wholeFile);

        $existingPets = Pet::getAll();

        $existingNames = array_map(function ($pet) {
            return $pet->getName();
        }, $existingPets);

        foreach ($allLines as $line) {
            $petsData = explode(";", $line);

            if (!in_array($petsData[0], $existingNames)) {
                $pet = new Pet(null, $petsData[0], $petsData[1], $petsData[2], $petsData[3]);
                $pet->save();
                $pets[] = $pet;
            }
        }
        return $pets;
    }
}
