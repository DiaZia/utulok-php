<?php

/** @var \App\Core\IAuthenticator $auth */
/** @var \App\Core\LinkGenerator $link */

use App\Models\Pet;

?>

<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div>
                    Vitaj, <strong><?= $auth->getLoggedUserName() ?></strong>!<br><br>
                    Táto časť aplikácie je prístupná len po prihlásení.
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <table class="table" border="1">
            <thead>
            <tr>
                <th>Name</th>
                <th>Edit</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $pets = Pet::getAll();
            foreach ($pets as $pet):
                ?>
                <tr>
                    <td><?= $pet->getName() ?></td>
                    <td>
                        <a href="<?= $link->url("admin.edit", ["id" => $pet->getId()]) ?>" class="edit-link" data-pet-id="<?= $pet->getId() ?>">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <?php if ($auth->isAdmin()): ?>
            <div>
                <a href="<?= $link->url("admin.newPet") ?>" id="addNewPet">Add New Pet</a>
            </div>
        <?php endif; ?>
    </div>

</main>
