<?php
use App\Models\Pet;
use App\Models\Adoption;
use App\Models\User;

/** @var Array $data */
/** @var Pet[] $pets */
/** @var \App\Core\Request $request */
/** @var \App\Core\LinkGenerator $link */
/** @var \App\Core\IAuthenticator $auth */

$users = User::getAll();
$name = $auth->getLoggedUserName();
$userId = null;
foreach ($users as $user) {
    if ($user->getUsername() === $name) {
        $userId = $user->getId();
    }
}

$pets = Pet::getAll();

$whereClause = 'userId = :userId';
$whereParams = ['userId' => $userId];
$adoptions = Adoption::getAll($whereClause, $whereParams);
$adoptionIdToCancel = null;

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["cancelAdoption"])) {
    $adoptionIdToCancel = $_POST["cancelAdoption"];
}

if ($adoptionIdToCancel !== null) {

    $adoptionIdToCancel = null;
}


?>
<main>
    <div class="adoptionsGrid">
        <?php if (count($adoptions) === 0) { ?>
            <p>Nemáte žiadne virtuálne adopcie.<br>
                Môžete nás <a href="<?= $link->url("home.support")?>" >podporiť tu.</a></p>
        <?php } else {
        foreach ($pets as $index => $pet) {
            foreach ($adoptions as $adoption) {
                if ($pet->getId() === $adoption->getPetId()) { ?>
            <div class="petAdoptions" id="adoption<?= $adoption->getId() ?>">
                <img src="<?php echo $pet->getImagePath() ?>" alt="0"
                     data-pet-index="<?php echo $index + 1?>">
                <div>
                    <a href="<?= $link->url("pet.pet", ["id" => $pet->getId()]) ?>">
                        <h3><?= $pet->getName() ?></h3>
                    </a>
                    <p>
                        Adoptovaný/á dňa: <?php echo $adoption->getDate() ?> <br>
                        Vek: <?php echo $pet->getAge();
                        if ($pet->getAge() === 1) { ?>
                            rok.<br>
                        <?php } else if ($pet->getAge() > 1 && $pet->getAge() < 5) { ?>
                            roky.<br>
                        <?php } else { ?>
                            rokov.<br>
                        <?php } ?>
                        <form class="cancelAdoptionForm" method="post" action="" onsubmit="return confirm('Chceš ukončiť virtuálnu adopciu tohto zvieratka?');">
                            <input type="hidden" name="cancelAdoption" value="<?= $adoption->getId() ?>">
                            <button type="submit">Zrušiť adopciu</button>
                        </form>
                    </p>
                </div>
            </div>
        <?php } } } } ?>
    </div>
</main>
