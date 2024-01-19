<?php
use App\Models\Pet;
use App\Models\PetDescription;
use App\Models\Adoption;
use App\Models\User;

/** @var Pet[] $pets */
/** @var User[] $users */
/** @var \App\Core\Request $request */
/** @var \App\Core\LinkGenerator $link */
/** @var \App\Core\IAuthenticator $auth */


$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$selectedPet = null;
$pets = Pet::getAll();
$description = null;
$descriptions = PetDescription::getAll();
$users = User::getAll();

$adoption = null;
$adoptions = Adoption::getAll();
$userId = null;

foreach ($pets as $pet) {
    if ($pet->getId() == $id) {
        $selectedPet = $pet;
        break;
    }
}

foreach ($descriptions as $d) {
    if ($d->getPetId() == $id) {
        $description = $d;
        break;
    }
}

if ($auth->isLogged()) {
    $name = $auth->getLoggedUserName();
    foreach ($users as $user) {
        if ($user->getUsername() === $name) {
            $userId = $user->getId();
        }
    }
}

$whereClause = 'userId = :userId AND petId = :petId';
$whereParams = ['userId' => $userId, 'petId' => $id];
$existingAdoption = Adoption::getAll($whereClause, $whereParams);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!$existingAdoption) {
        $adoption = new Adoption(null, $userId, $id, date('Y-m-d H:i:s', time()));
        $adoption->save();
        echo 'Zvieratko úspešne adoptované.';
    }
    $existingAdoption = Adoption::getAll($whereClause, $whereParams);
}
?>

<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adopčný formulár</title>
    <script src="public/js/script.js"></script>
</head>
<body>
<main>
    <div class="pet-carousel-container">
        <div class="pet-carousel">
            <img src="<?= $selectedPet->getImagePath(); ?>" alt="<?= $selectedPet->getName(); ?>" class="pet-carousel-image">
        </div>
        <button class="arrow prev">&#10094;</button>
        <button class="arrow next">&#10095;</button>
        <button class="adopt" onclick="<?php echo ($auth->isLogged()) ? ((!$existingAdoption) ? 'openForm()' : 'adoptedAlert()')  :
             'showLoginAlert()'; ?>">Adoptuj si ma!</button>

        <form id="adoptForm" method="post">
            <input type="hidden" name="userId" value="<?php echo $auth->getLoggedUserId(); ?>">
            <input type="hidden" name="petId" value="<?php echo $id; ?>">
            <button class="close" onclick="closeForm()">X</button>
            <label>
                <p><strong>VIRTUÁLNA ADOPCIA</strong><br>
                Chceš si virtuálne adoptovať zvieratko a prispievať na jeho život?</p>
            </label>
            <br>
            <button type="submit">Potvrdiť</button>
        </form>

        <div class="pet-details">
            <h3><?= $selectedPet->getName(); ?></h3>
            <p style="white-space: pre-line" class="description" onclick=""><?= $description->getDescription(); ?></p>
            <p>
                <strong>Virtuálni majitelia:<br></strong>
            <?php
            foreach ($adoptions as $index => $adoption) {
                if ($adoption->getPetId() === $id) {
                    $adoptionUser = $adoption->getUserId();
                    foreach ($users as $user) {
                        if ($user->getId() === $adoptionUser) {
                            echo $user->getUsername() . "<br>";
                        }
                    }
                }
            }
            ?>
            </p>
        </div>
    </div>
    <script>
        const petId = <?= $id ?>;
    </script>
</main>
</body>


