<?php

use App\Models\Product;
use App\Models\Cart;
use App\Models\User;


require __DIR__ . '/../../../App/Models/Product.php';
require __DIR__ . '/../../../App/Models/Cart.php';
require __DIR__ . '/../../../App/Models/User.php';

/** @var \App\Core\IAuthenticator $auth */
/** @var \App\Core\LinkGenerator $link */

$users = User::getAll();
$userId = null;
$name = null;
if ($auth !== null) {
    if ($auth->isLogged()) {
        $name = $auth->getLoggedUserName();
    }
}


foreach ($users as $user) {
    if ($user->getUsername() === $name) {
        $userId = $user->getId();
    }
}

$whereClause = 'userId = :userId';
$whereParams = ['userId' => $userId];
$carts = Cart::getAll($whereClause, $whereParams);

$products = Product::getAll();

function calculateTotalPrice($carts, $products) {
    $totalPrice = 0;
    foreach ($carts as $cart) {
        $productId = $cart->getProductId();
        foreach ($products as $product) {
            if ($productId === $product->getId()) {
                $selected = $product;
                $totalPrice += $selected->getPrice() * $cart->getQuantity();
            }
        }
    }
    return $totalPrice;
}

$totalPrice = calculateTotalPrice($carts, $products);


?>


<main class="cart" name="cart" data-cart-userId="<?= $userId?>">
    <?php if ($auth->isLogged()) { ?>
    <div class="shoppingCart">
        <ul>
            <li class="header">
                <span>Produkt</span>
                <span>Názov</span>
                <span>Cena</span>
                <span>Množstvo</span>
                <span>Zrušiť</span>
            </li>
            <?php
            foreach ($carts as $cart) {
                $productId = $cart->getProductId();
                foreach ($products as $product) {
                    if ($productId === $product->getId()) {
                        $selected = $product;
                    }
                }

            ?>
                <li id="cart<?= $cart->getId() ?>">
                    <span>
                        <a href="<?= $link->url("home.product", ["id" => $selected->getId()]) ?>">
                         <img src="<?= $selected->getImagePath(); ?>">
                        </a>
                    </span>
                    <span><?= $selected->getName()?> </span>
                    <span><?= $selected->getPrice()?> €</span>
                    <span>
                        <input type="number" name="quantity-input" value="<?= $cart->getQuantity() ?>" min="1" max="10" class="quantity-input" data-cart-id="<?= $cart->getId() ?>">
                        ks.
                        <input type="hidden" id="userName" name="name" value="<?= $name ?>">
                    </span>
                    <form class="deleteProductForm" method="post" action="" onsubmit="return confirm('Chceš odstrániť tento produkt z košíka?');">
                        <input type="hidden" name="deleteProduct" value="<?= $cart->getId() ?>">
                        <button class="delete" type="submit">
                            <img src="public/images/delete.jpg">
                        </button>
                    </form>
                </li>
            <?php } ?>
        </ul>
    </div>
    <div class="priceClass">
        <h3 id="totalPrice"><?= 'Cena spolu: ' . number_format($totalPrice, 2) . ' €' ?></h3>

        <button>Objednať</button>
    </div>
    <?php } else { ?>
        <h5>Pre prístup do košíka sa musíte prihlásiť.</h5>
    <?php } ?>
</main>