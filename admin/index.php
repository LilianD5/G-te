<?php
session_start();

require_once '../connect.php';


if (isset($_POST['login_admin'])) {
    $login_admin = $_POST['login_admin']; //Vérifer chez Xhesika
    $pass_admin = $_POST['pass_admin']; //Verifier chez Xhesika
    var_dump($login_admin);
    var_dump($pass_admin);

    $req = $db->prepare('SELECT `id_admin`, `login_admin`, `pass_admin` FROM `admin`');

    $req->bindParam('login_admin', $login_admin, PDO::PARAM_STR);

    $req->execute();

    $log = $req->fetch(PDO::FETCH_ASSOC);

    if ($req->rowCount() > 0 && $log['pass_admin'] == $pass_admin) {
        $_SESSION['adminId'] = $log['id_admin'];
        header('Location:gite.php');
        var_dump($_SESSION);
    } else {
        $message = 'Erreur login_admin/password';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600&family=Montserrat:wght@100;200;300;400&family=Roboto+Slab:wght@100;200;300;400;500;600&display=swap" rel="stylesheet">
    <link rel="icon" size="16x16" type="image/png" href="../templates/img/icon/icon.png">
    <link rel="stylesheet" href="../templates/css/style-admin.css">
    <title>Connexion admin</title>
</head>

<body class="background-index">
    <!-- FORMULAIRE DE CONNEXION -->
    <section class="form-connexion">
        <h2 class="titre-form-connexion">Connectez-vous à votre compte administrateur</h2>
        <form action="#" method="POST">
            <?php if (isset($message)) { ?>
                <p class="invalid"><?= $message ?></p>
            <?php } ?>
            <label for="login_admin" class="id-connect">Identifiant</label>
            <input type="text" name="login_admin" id="login_admin" placeholder="Identifiant" class="input-connect" required>

            <label for="pass_admin" class="id-connect">Mot de passe</label>
            <input type="password" name="pass_admin" id="pass_admin" class="input-connect" required>

            <button type="submit" class="btn-connect">Connexion</button>

        </form>
    </section>

</body>

</html>