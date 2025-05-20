<?php
require_once 'db.php'; // Connexion à la base de données

$stmt = $pdo->query("SELECT * FROM patients");
$patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Liste des patients - Hôpital</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

  <?php include 'header.php'; ?>

  <!-- Bandeau de mise à jour -->
  <div class="alert alert-success" role="alert">
    🆕 Version mise à jour le <strong>20 mai 2025</strong>
  </div>

  <h1 class="mb-4">📅 Prendre un rendez-vous</h1>

  <h1 class="mb-4">👨‍⚕️ Liste des patients</h1>
  <table class="table table-bordered">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Date de naissance</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($patients as $p): ?>
        <tr>
          <td><?= $p['id'] ?></td>
          <td><?= htmlspecialchars($p['nom']) ?></td>
          <td><?= htmlspecialchars($p['prenom']) ?></td>
          <td><?= $p['date_naissance'] ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <a href="rdv.php" class="btn btn-primary">Prendre un rendez-vous</a>

</body>
</html>
