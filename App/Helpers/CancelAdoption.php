<?php

namespace App\Helpers;

use App\Models\Adoption;


require __DIR__ . '/../../App/Config/Configuration.php';
require __DIR__ . '/../../App/Core/DB/DebugStatement.php';
require __DIR__ . '/../../App/Core/DB/Connection.php';
require __DIR__ . '/../../App/Helpers/Inflect.php';
require __DIR__ . '/../../App/Core/Model.php';
require __DIR__ . '/../../App/Models/Adoption.php';

class CancelAdoption
{

    public static function cancel() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            echo "Reached inside cancel";
            if (isset($_POST["cancelAdoption"])) {
                $adoptionIdToCancel = $_POST["cancelAdoption"];
                $adoption = null;

                $whereClause = 'id = :id';
                $whereParams = ['id' => $adoptionIdToCancel];

                try {
                    $adoption = Adoption::getAll($whereClause, $whereParams);
                } catch (Exception $e) {
                    echo "Exception: " . $e->getMessage();
                }
                if ($adoption !== null) {
                    $adoption[0]->delete();
                    echo "Adoption canceled successfully";
                } else {
                    echo "Adoption not found";
                }
            }
        }
        exit;
    }
}

CancelAdoption::cancel();

