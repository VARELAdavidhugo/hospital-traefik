<?php
require_once 'db.php';

$stmt = $pdo->query("SELECT * FROM rdv ORDER BY date_rdv DESC");
$rdvs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Liste des rendez-vous</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<?php include 'header.php'; ?>

<h1 class="mb-4">📋 Liste des rendez-vous enregistrés</h1>

<table class="table table-bordered">
  <thead class="table-light">
    <tr>
      <th>ID</th>
      <th>Nom</th>
      <th>Prénom</th>
      <th>Date du rendez-vous</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($rdvs as $rdv): ?>
    <tr>
      <td><?= $rdv['id'] ?></td>
      <td><?= htmlspecialchars($rdv['nom']) ?></td>
      <td><?= htmlspecialchars($rdv['prenom']) ?></td>
      <td><?= $rdv['date_rdv'] ?></td>
      <td>
        <a href="supprimer-rdv.php?id=<?= $rdv['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce rendez-vous ?');">Supprimer</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<a href="index.php" class="btn btn-secondary">⬅️ Retour à l’accueil</a>

</body>
</html>
