<?php

session_start();

if (!isset($_SESSION['utilisateur'])) {
    header('Location: login.php');
    exit;
}

require 'config/database.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];

/* Récupération du personnel */
$sql = $pdo->prepare("SELECT * FROM personnel WHERE id = ?");
$sql->execute([$id]);
$personnel = $sql->fetch();

if (!$personnel) {
    header('Location: index.php');
    exit;
}

/* Mise à jour */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $sql = $pdo->prepare("
        UPDATE personnel
        SET nom = ?, prenom = ?, service = ?, telephone = ?, email = ?
        WHERE id = ?
    ");

    $sql->execute([
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['service'],
        $_POST['telephone'],
        $_POST['email'],
        $id
    ]);

    header('Location: index.php');
    exit;
}

include 'includes/header.php';
?>

<div class="form-container">

    <div class="form-box">

        <h2>Modifier un personnel</h2>

        <form method="post">

            <label>Nom</label>
            <input type="text" name="nom" class="form-control"
                   value="<?= htmlspecialchars($personnel['nom']) ?>" required>

            <label>Prénom</label>
            <input type="text" name="prenom" class="form-control"
                   value="<?= htmlspecialchars($personnel['prenom']) ?>" required>

            <label>Service</label>
            <input type="text" name="service" class="form-control"
                   value="<?= htmlspecialchars($personnel['service']) ?>" required>

            <label>Téléphone</label>
            <input type="text" name="telephone" class="form-control"
                   value="<?= htmlspecialchars($personnel['telephone']) ?>">

            <label>Email</label>
            <input type="email" name="email" class="form-control"
                   value="<?= htmlspecialchars($personnel['email']) ?>">

            <br>

            <button class="btn btn-add" type="submit">
                Mettre à jour
            </button>

            <a href="index.php" class="btn btn-delete">
                Annuler
            </a>

        </form>

    </div>

</div>

<?php include 'includes/footer.php'; ?>