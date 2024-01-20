<?php
use App\Models\Product;
use App\Models\Cart;
use \App\Models\User;

/** @var \App\Core\IAuthenticator $auth */

$users = User::getAll();
$userId = null;
if ($auth->isLogged()) {
    $name = $auth->getLoggedUserName();
    foreach ($users as $user) {
        if ($user->getUsername() === $name) {
            $userId = $user->getId();
        }
    }

    $whereClause = 'userId = :userId';
    $whereParams = ['userId' => $userId];
    $carts = Cart::getAll($whereClause, $whereParams);

    $products = Product::getAll();

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

    $productIdToDelete = null;

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["deleteProduct"])) {
        $productIdToDelete = $_POST["deleteProduct"];
    }

}


?>


<main class="cart">
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
                    <img src="<?= $selected->getImagePath(); ?>">
                    <span><?= $selected->getName()?> </span>
                    <span><?= $selected->getPrice()?> €</span>
                    <span><?= $cart->getQuantity()?> ks.</span>
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
        <h3><?= 'Cena spolu: ' . number_format($totalPrice, 2) . ' €' ?></h3>
        <button>Objednať</button>
    </div>
    <?php } else { ?>
        <h5>Pre prístup do košíka sa musíte prihlásiť.</h5>
    <?php } ?>
</main>