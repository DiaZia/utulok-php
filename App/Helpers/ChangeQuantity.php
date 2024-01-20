<?php

namespace App\Helpers;
use App\Models\Cart;

require __DIR__ . '/../../App/Config/Configuration.php';
require __DIR__ . '/../../App/Core/DB/DebugStatement.php';
require __DIR__ . '/../../App/Core/DB/Connection.php';
require __DIR__ . '/../../App/Helpers/Inflect.php';
require __DIR__ . '/../../App/Core/Model.php';
require __DIR__ . '/../../App/Models/Cart.php';
class ChangeQuantity
{

    public static function change() {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["cartId"], $_POST["newQuantity"])) {
            $cartId = $_POST["cartId"];
            $newQuantity = $_POST["newQuantity"];

            try {
                $whereClause = 'id = :id';
                $whereParams = ['id' => $cartId];
                $cart = Cart::getAll($whereClause, $whereParams);
                $selectedCart = $cart[0];
                $selectedCart->setQuantity($newQuantity);
                $selectedCart->save();
                echo "Quantity updated successfully";
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
        exit;
    }
}

ChangeQuantity::change();