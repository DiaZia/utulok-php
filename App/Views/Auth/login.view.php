<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$layout = 'auth';
/** @var Array $data */
/** @var \App\Core\LinkGenerator $link */

$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['prihlasovacie_meno'];
    $password = $_POST['prihlasovacie_heslo'];
    $db = \App\Core\DB\Connection::connect();

    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($username == "admin" && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $username;
        header('Location: ?c=admin&a=index');
        exit();
    } else if (!$user || !password_verify($password, $user['password'])) {
        $error = "Nesprávne meno alebo heslo.";
    } else {
        $_SESSION['user'] = $username;
        header('Location: ?c=home&a=index');
        exit();
    }
}
?>

<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h2 class="login">Prihlásenie</h2>
                    <form class="loginForm" method="post" action="<?= $link->url("login") ?>"
                          onsubmit="return validateForm()">
                        <label for="prihlasovacie_meno">Prihlasovacie meno:</label>
                        <input type="text" id="prihlasovacie_meno" name="prihlasovacie_meno" required><br><br>

                        <label for="prihlasovacie_heslo">Heslo:</label>
                        <input type="password" id="prihlasovacie_heslo" name="prihlasovacie_heslo" required><br><br>

                        <input type="submit" value="Prihlásiť">
                        <?php if (isset($error)): ?>
                            <p class="error"><?= $error ?></p>
                        <?php endif; ?>
                    </form>
                    <div class="newAccount">
                        <a href="<?= $link->url("auth.register") ?>">Ešte nemáte účet?
                            <strong>Vytvorte si ho.</strong></a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
