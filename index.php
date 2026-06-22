<?php

session_start();

if (!isset($_SESSION['utilisateur']))
{
    header('Location: login.php');
    exit;
}
?>

<h1>Annuaire</h1>

<p>Bienvenue <?= $_SESSION['utilisateur'] ?></p>

<a href="logout.php">Déconnexion</a>