<?php

$layout = 'auth';
/** @var Array $data */
/** @var \App\Core\LinkGenerator $link */
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h2 class="login">Prihlásenie</h2>
                        <form class="loginForm" method="post" action="<?= $link->url("login") ?>">
                            <label for="prihlasovacie_meno">Prihlasovacie meno:</label>
                            <input type="text" id="prihlasovacie_meno" name="prihlasovacie_meno" required><br><br>

                            <label for="heslo">Heslo:</label>
                            <input type="password" id="heslo" name="heslo" required><br><br>

                            <input type="submit" value="Prihlásiť">
                        </form>
                        <div class="newAccount">
                            <a href="#">Ešte nemáte účet? <strong>Vytvorte si ho.</strong></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
