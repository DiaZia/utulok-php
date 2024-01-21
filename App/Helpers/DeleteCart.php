<?php

namespace App\Helpers;
use App\Models\Cart;
use App\Models\Product_Order;

require_once __DIR__ . '/../../App/Config/Configuration.php';
require_once __DIR__ . '/../../App/Core/DB/DebugStatement.php';
require_once __DIR__ . '/../../App/Core/DB/Connection.php';
require_once __DIR__ . '/../../App/Helpers/Inflect.php';
require_once __DIR__ . '/../../App/Core/Model.php';
require_once __DIR__ . '/../../App/Models/Cart.php';
require_once __DIR__ . '/../../App/Models/Product_Order.php';



$userId = $_POST['userId'] ?? null;
$orderId = $_POST['orderId'] ?? null;

if ($userId !== null) {
    $whereClause = 'userId = :userId';
    $whereParams = ['userId' => $userId];
    $carts = Cart::getAll($whereClause, $whereParams);

    foreach ($carts as $cart) {
        $product = new Product_Order(null, $cart->getProductId(), $orderId, $cart->getQuantity());
        $product->save();
        $cart->delete();
    }
}
