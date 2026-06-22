<?php

session_start();

require 'config/database.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $login = trim($_POST['login']);
    $motdepasse = trim($_POST['motdepasse']);

    $sql = $pdo->prepare(
        "SELECT * FROM utilisateurs WHERE login = ?"
    );

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

include 'includes/header.php';
?>

<div class="login-container">

    <div class="login-box">

        <h1>Annuaire du Personnel</h1>

        <form method="post">

            <div class="form-group">
                <label>Identifiant</label>

                <input
                    class="form-control"
                    type="text"
                    name="login"
                    required>
            </div>

            <div class="form-group">
                <label>Mot de passe</label>

                <input
                    class="form-control"
                    type="password"
                    name="motdepasse"
                    required>
            </div>

            <?php if(!empty($message)) : ?>

                <div class="error-message">
                    <?= $message ?>
                </div>

            <?php endif; ?>

            <button class="btn" type="submit">
                Se connecter
            </button>

        </form>

    </div>

</div>

<?php include 'includes/footer.php'; ?>