<?php
require_once 'db.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM rdv WHERE id = ?");
    $stmt->execute([$id]);
}

header('Location: liste-rdv.php');
exit;

