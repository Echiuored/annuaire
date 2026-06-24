<?php

session_start();

if (!isset($_SESSION['utilisateur'])) {
    header('Location: login.php');
    exit;
}

require 'config/database.php';

$search = $_GET['search'] ?? '';

if (!empty($search)) {
    $sql = $pdo->prepare("
        SELECT * FROM personnel
        WHERE nom LIKE ?
        OR prenom LIKE ?
        OR service LIKE ?
        ORDER BY nom ASC
    ");

    $sql->execute([
        "%$search%",
        "%$search%",
        "%$search%"
    ]);

} else {
    $sql = $pdo->query("SELECT * FROM personnel ORDER BY nom ASC");
}

$personnels = $sql->fetchAll();

include 'includes/header.php';
?>
<form method="GET" class="search-bar">

    <input
        type="text"
        name="search"
        placeholder="Rechercher un nom, prénom ou service..."
        value="<?= htmlspecialchars($search) ?>">

    <button type="submit" class="btn btn-search">
        🔍 Rechercher
    </button>

    <a href="index.php" class="btn btn-reset">
        ✖ Effacer
    </a>

</form>

<div class="container">

   <div class="page-header">

    <h2>Liste du personnel</h2>
    <br>
 </div>
 <div class="page-header">
    <a class="btn btn-add" href="ajouter.php">
        + Ajouter un personnel
    </a>
    <a class="btn btn-add" href="export_pdf.php">
     📄 Export PDF
    </a>
    <a href="statistiques.php" class="btn btn-add">
    📊 Statistiques
    </a>

</div>

    <br><br>

    <table class="table">

        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Service</th>
            <th>Téléphone</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>

        <?php foreach ($personnels as $p): ?>

        <tr>
            <td><?= htmlspecialchars($p['nom']) ?></td>
            <td><?= htmlspecialchars($p['prenom']) ?></td>
            <td><?= htmlspecialchars($p['service']) ?></td>
            <td><?= htmlspecialchars($p['telephone']) ?></td>
            <td><?= htmlspecialchars($p['email']) ?></td>

            <td>
                <a class="btn-small btn-edit" href="modifier.php?id=<?= $p['id'] ?>">
                    Modifier
                </a>

                <a class="btn-small btn-delete"
                   href="supprimer.php?id=<?= $p['id'] ?>"
                   onclick="return confirm('Supprimer ce personnel ?')">
                    Supprimer
                </a>
            </td>
        </tr>

        <?php endforeach; ?>

    </table>

</div>

<?php include 'includes/footer.php'; ?>