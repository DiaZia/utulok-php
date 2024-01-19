<?php
use App\Models\Product;

/** @var Product[] $products */
/** @var \App\Core\LinkGenerator $link */

$products = Product::getAll();
?>

<main>
    <div class="grid">
        <?php foreach ($products as $index => $product) { ?>
            <div class="product">
                <a href="<?= $link->url("home.product", ["id" => $product->getId()]) ?>">
                <img src="<?php echo $product->getImagePath() ?>" alt="0"
                     data-pet-index="<?php echo $index + 1?>">
                </a>
                <h4><?= $product->getName() ?></h4>
                <h4><?= $product->getPrice() ?>€</h4>
            </div>
        <?php } ?>
</main>