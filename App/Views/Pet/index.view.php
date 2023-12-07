<?php
use App\Models\Pet;

/** @var Array $data */
/** @var Pet[] $pets */
/** @var \App\Core\Request $request */
/** @var \App\Core\LinkGenerator $link */

$pets = $data['pets'];


?>
<main  class="mainPets">
    <div class="grid">
        <?php foreach ($pets as $index => $pet) { ?>
            <div class="pet">
                <img src="<?php echo $pet->getImagePath() ?>" alt="0"
                     data-pet-index="<?php echo $index + 1?>" onclick="imageChange(this)">
                <h3><?php echo $pet->getName() ?></h3>
            </div>
        <?php } ?>

    </div>
</main>
