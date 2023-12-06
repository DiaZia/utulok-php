<?php

use App\Models\User;

$layout = 'auth';
/** @var Array $data */
/** @var \App\Core\LinkGenerator $link */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['meno'];
    $email = $_POST['email'];
    $password = password_hash($_POST['heslo'], PASSWORD_DEFAULT);

    $user = new User($username, $email, $password);

    $db = \App\Core\DB\Connection::connect();

    if (isUsernameTaken($username, $db)) {
        $error = "Meno je už obsadené.";
    } elseif (isEmailTaken($email, $db)) {
        $error = "Email je už obsadený.";
    } else {
        $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        $_SESSION['user'] = $username;
        header('Location: ?c=home&a=index');
        exit();
    }
}

function isUsernameTaken($username, $db)
{
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    return $stmt->fetch() !== false;
}

function isEmailTaken($email, $db)
{
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    return $stmt->fetch() !== false;
}

?>

<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h2 class="registration login">Registrácia</h2>
                    <form class=loginForm id="registrationForm" method="post"
                          action="<?= $link->url("register") ?>" onsubmit="return validateRegistrationForm()">
                        <label for="meno">Registračné meno:</label>
                        <input type="text" id="meno" name="meno" required><br><br>

                        <label for="email">E-mail:</label>
                        <input type="email" id="email" name="email" required><br><br>

                        <label for="heslo">Heslo:</label>
                        <input type="password" id="heslo" name="heslo" required><br><br>

                        <label for="potvrdit_heslo">Potvrdiť heslo:</label>
                        <input type="password" id="potvrdit_heslo" name="potvrdit_heslo" required><br><br>

                        <input type="submit" value="Registrovať">
                        <?php if (isset($error)) : ?>
                            <p class="error"><?= $error ?></p>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

