<?php
$host = 'mariadb_hopital'; // nom du service MariaDB dans docker-compose.yml
$db   = 'hospitaldb';       // nom de la base de données
$user = 'hopital';          // utilisateur MariaDB
$pass = 'hopital123';       // mot de passe de l’utilisateur
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass);
} catch (\PDOException $e) {
    echo "❌ Erreur de connexion : " . $e->getMessage();
    exit;
}
?>
