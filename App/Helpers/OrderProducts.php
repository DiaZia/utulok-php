<?php

use App\Models\Cart;
use App\Models\UsersOrder;
use App\Models\Product;

require_once __DIR__ . '/../../App/Config/Configuration.php';
require_once __DIR__ . '/../../App/Core/DB/DebugStatement.php';
require_once __DIR__ . '/../../App/Core/DB/Connection.php';
require_once __DIR__ . '/../../App/Helpers/Inflect.php';
require_once __DIR__ . '/../../App/Core/Model.php';
require_once __DIR__ . '/../../App/Models/Cart.php';
require_once __DIR__ . '/../../App/Models/Product.php';
require_once __DIR__ . '/../../App/Models/UsersOrder.php';

$userId = $_POST['userId'] ?? null;

if ($userId !== null) {
    $whereClause = 'userId = :userId';
    $whereParams = ['userId' => $userId];
    $carts = Cart::getAll($whereClause, $whereParams);

    $totalPrice = 0;
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
    $order = new UsersOrder(null, $userId, number_format($totalPrice, 2));
    $order->save();
    $orderId = $order->getId();
    header('Content-Type: application/json');
    echo json_encode(['orderId' => $orderId]);
}


