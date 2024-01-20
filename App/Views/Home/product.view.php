<?php
use App\Models\Product;
use App\Models\Cart;
use \App\Models\User;
use \App\Models\ProductDescription;
/** @var Product[] $products */
/** @var \App\Core\IAuthenticator $auth */
/** @var \App\Core\LinkGenerator $link */


$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$products = Product::getAll();
$selectedProduct = null;
foreach ($products as $product) {
    if ($product->getId() == $id) {
        $selectedProduct = $product;
        break;
    }
}


$users = User::getAll();
$userId = null;
if ($auth->isLogged()) {
    $name = $auth->getLoggedUserName();
    foreach ($users as $user) {
        if ($user->getUsername() === $name) {
            $userId = $user->getId();
        }
    }
}

$descriptions = ProductDescription::getAll();
$productDescription = null;
foreach ($descriptions as $description) {
    if ($description->getProductId() === $selectedProduct->getId()) {
        $productDescription = $description->getDescription();
    }
}

$whereClause = 'userId = :userId';
$whereParams = ['userId' => $userId];
$carts = Cart::getAll($whereClause, $whereParams);
$found = false;
$foundCart = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add']) && $_POST['add'] === "true") {
    foreach ($carts as $cart) {
        if ($cart->getProductId() === $selectedProduct->getId()) {
            $found = true;
            $foundCart = $cart;
        }
    }
    $message = '';
    $quantity = null;
    $done = 0;
    if (isset($_POST['quantity']) && $quantity === null) {
        $quantity = $_POST['quantity'];
        if ($found) {
            $foundCart->plusQuantity($quantity);
            $foundCart->save();
        } else {
            $newCart = new Cart(null, $userId, $selectedProduct->getId(), $quantity);
            $newCart->save();
        }
        $done = 1;
        $quantity = null;
    }
    $carts = Cart::getAll($whereClause, $whereParams);

    $redirectUrl = $link->url("home.product", ["id" => $selectedProduct->getId()]);
    header("Location: $redirectUrl");
    exit;
}

?>

<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="public/js/script.js"></script>
</head>
<body>
<main>
    <div class="productClass">
        <img src="<?= $selectedProduct->getImagePath(); ?>" alt="productImg">
        <div class="productInfo">
            <h4 class="productProperty"><?= $selectedProduct->getName() ?></h4>
            <p class="productProperty" style="white-space: pre-line">Popis produktu: <br><?= $productDescription ?></p>
            <h4 class="productProperty"><?= $selectedProduct->getPrice() ?>€</h4>
            <form method="post" id="addToCartForm">
                <label class="productProperty" for="quantity">Množstvo:</label>
                <input class="productProperty" type="number" id="quantity" name="quantity" min="1" max="10" value="1">
                <div class="productProperty">
                    <button id="cartButton" type="button"  <?php echo ($auth->isLogged()) ? ' onclick="addToCart()"' :
                        'onclick="showLoginAlert()"'; ?>>Pridať do košíka</button>
                </div>
            </form>
        </div>
    </div>
</main>
</body>