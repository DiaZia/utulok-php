<?php
use App\Models\Pet;

/** @var Pet[] $pets */
/** @var \App\Core\Request $request */
/** @var \App\Core\LinkGenerator $link */

$id = $_GET['id'];
$selectedPet = null;
$pets = Pet::getAll();

// Find the selected pet based on the ID
foreach ($pets as $pet) {
    if ($pet->getId() == $id) {
        $selectedPet = $pet;
        break;
    }
}
?>

<main>
    <div class="pet-carousel-container">
        <div class="pet-carousel">
            <img src="<?= $selectedPet->getImagePath(); ?>" alt="<?= $selectedPet->getName(); ?>" class="pet-carousel-image">
        </div>
        <button class="arrow prev">&#10094;</button>
        <button class="arrow next">&#10095;</button>
        <div class="pet-details">
            <h3><?= $selectedPet->getName(); ?></h3>
        </div>
    </div>
    <script>
        const petId = <?= $id ?>;
    </script>
    <script src="public/js/script.js"></script>
</main>


