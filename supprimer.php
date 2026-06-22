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

/* Vérifier que le personnel existe */
$sql = $pdo->prepare("SELECT id FROM personnel WHERE id = ?");
$sql->execute([$id]);

$personnel = $sql->fetch();

if (!$personnel) {
    header('Location: index.php');
    exit;
}

/* Suppression */
$sql = $pdo->prepare("DELETE FROM personnel WHERE id = ?");
$sql->execute([$id]);

header('Location: index.php');
exit;