<?php

session_start();
require 'config/database.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $login = $_POST['login'];
    $motdepasse = $_POST['motdepasse'];

    $sql = $pdo->prepare("SELECT * FROM utilisateurs WHERE login = ?");
    $sql->execute([$login]);

    $user = $sql->fetch();

    if ($user && $user['motdepasse'] === $motdepasse)
    {
        $_SESSION['utilisateur'] = $user['login'];

        header('Location: index.php');
        exit;
    }
    else
    {
        $message = "Identifiant ou mot de passe incorrect";
    }
}
?>

<h2>Connexion</h2>

<form method="post">

    <input type="text" name="login" placeholder="Login"><br><br>

    <input type="password" name="motdepasse" placeholder="Mot de passe"><br><br>

    <button>Se connecter</button>

</form>

<p style="color:red">
    <?= $message ?>
</p>
