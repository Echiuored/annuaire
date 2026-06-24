<?php include 'includes/meteo.php'; ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annuaire du Personnel</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<header class="topbar">

    <div class="logo">
        📇 Annuaire RH
    </div>
    <div class="meteo">
    <span class="ville">
        <?= $villeAffichee ?>
    </span>

    <img src="https://openweathermap.org/img/wn/<?= $icone ?>.png">

    <span>
        <?= $temperature ?>°C - <?= $description ?>
    </span>
    </div>

    <nav class="menu">
        <a href="index.php">Accueil</a>
        <a href="ajouter.php">Ajouter</a>
        <a href="logout.php" class="logout">Déconnexion</a>
    </nav>

</header>

<div class="container">