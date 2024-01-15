<?php

/** @var \App\Core\IAuthenticator $auth */ ?>

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
    <!-- Pet List Page -->
    <div class="container">
        <h2>Pet List</h2>
        <ul>
            <?php $pets = \App\Models\Pet::getAll();
                foreach ($pets as $pet): ?>
                <li>
                    <a href="#">
                        <?= $pet->getName() ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>

        <?php if ($auth->isAdmin()): ?>
            <div>
                <a href="#">Add New Pet</a>
            </div>
        <?php endif; ?>
    </div>

</main>
