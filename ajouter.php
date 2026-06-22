<?php

session_start();

if (!isset($_SESSION['utilisateur'])) {
    header('Location: login.php');
    exit;
}

require 'config/database.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $sql = $pdo->prepare("
        INSERT INTO personnel (nom, prenom, service, telephone, email)
        VALUES (?, ?, ?, ?, ?)
    ");

    $sql->execute([
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['service'],
        $_POST['telephone'],
        $_POST['email']
    ]);

    header('Location: index.php');
    exit;
}

include 'includes/header.php';
?>

<div class="form-container">

    <div class="form-box">

        <h2>Ajouter un personnel</h2>

        <form method="post">

            <label>Nom</label>
            <input type="text" name="nom" class="form-control" required>

            <label>Prénom</label>
            <input type="text" name="prenom" class="form-control" required>

            <label>Service</label>
            <input type="text" name="service" class="form-control" required>

            <label>Téléphone</label>
            <input type="text" name="telephone" class="form-control">

            <label>Email</label>
            <input type="email" name="email" class="form-control">

            <br>

            <button class="btn btn-add" type="submit">
                Enregistrer
            </button>

        </form>

    </div>

</div>

<?php include 'includes/footer.php'; ?>