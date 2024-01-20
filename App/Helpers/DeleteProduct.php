<?php

namespace App\Models;


require __DIR__ . '/../../ClassLoader.php';
require __DIR__ . '/../../App/Core/DB/Connection.php';
require __DIR__ . '/../../App/Config/Configuration.php';
require __DIR__ . '/../../App/Helpers/Inflect.php';
require __DIR__ . '/../../App/Core/DB/DebugStatement.php';
require __DIR__ . '/../../App/Core/Model.php';
require __DIR__ . '/../../App/Models/Product.php';
require __DIR__ . '/../../App/Models/Cart.php';

class DeleteProduct
{
    public static function delete()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (isset($_POST["deleteProduct"])) {
                $productIdToDelete = $_POST["deleteProduct"];
                $product = null;

                $whereClause = 'id = :id';
                $whereParams = ['id' => $productIdToDelete];

                try {
                    $product = Cart::getAll($whereClause, $whereParams);
                } catch (Exception $e) {
                    echo "Exception: " . $e->getMessage();
                }

                if ($product !== null) {
                    $product[0]->delete();
                    echo "Produkt úspešne vymazaný.";
                } else {
                    echo "Produkt sa nenašiel.";
                }
            } else {
                echo "";
            }
        } else {
            echo "Invalid request method";
        }
    }
}

DeleteProduct::delete();