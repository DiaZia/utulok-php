<?php

namespace App\Helpers;
use App\Models\Cart;
use App\Models\Product;

require __DIR__ . '/../../App/Config/Configuration.php';
require __DIR__ . '/../../App/Core/DB/DebugStatement.php';
require __DIR__ . '/../../App/Core/DB/Connection.php';
require __DIR__ . '/../../App/Helpers/Inflect.php';
require __DIR__ . '/../../App/Core/Model.php';
require __DIR__ . '/../../App/Models/Product.php';
require __DIR__ . '/../../App/Models/Cart.php';
class CalculatePrice
{

    public static function calculate() {
        $totalPrice = 0;
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (isset($_POST["userId"])) {
                $userId = $_POST["userId"];
                $whereClause = 'userId = :userId';
                $whereParams = ['userId' => $userId];
                $carts = Cart::getAll($whereClause, $whereParams);
                $products = Product::getAll();

                foreach ($carts as $cart) {
                    $productId = $cart->getProductId();
                    foreach ($products as $product) {
                        if ($productId === $product->getId()) {
                            $selected = $product;
                            $totalPrice += $selected->getPrice() * $cart->getQuantity();
                        }
                    }
                }
            }
        }
        header('Content-Type: application/json');
        echo json_encode(['totalPrice' => $totalPrice]);
        exit;

    }
}
CalculatePrice::calculate();