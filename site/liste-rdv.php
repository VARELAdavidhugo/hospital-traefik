<?php
require_once 'db.php';

$query = $pdo->query("
  SELECT rdv.id, rdv.date_rdv, rdv.motif, rdv.statut,
         patients.nom AS patient_nom, patients.prenom AS patient_prenom,
         medecins.nom AS medecin_nom, medecins.prenom AS medecin_prenom,
         specialites.nom AS specialite
  FROM rdv
  JOIN patients ON rdv.patient_id = patients.id
  JOIN medecins ON rdv.medecin_id = medecins.id
  LEFT JOIN specialites ON medecins.specialite_id = specialites.id
  ORDER BY rdv.date_rdv DESC
");

$rdvs = $query->fetchAll(PDO::FETCH_ASSOC);
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
      <th>Patient Nom</th>
      <th>Patient Prénom</th>
      <th>Médecin Nom</th>
      <th>Médecin Prénom</th>
      <th>Spécialité</th>
      <th>Date du rendez-vous</th>
      <th>Motif</th>
      <th>Statut</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($rdvs as $rdv): ?>
    <tr>
      <td><?= $rdv['id'] ?></td>
      <td><?= htmlspecialchars($rdv['patient_nom'] ?? '') ?></td>
      <td><?= htmlspecialchars($rdv['patient_prenom'] ?? '') ?></td>
      <td><?= htmlspecialchars($rdv['medecin_nom'] ?? '') ?></td>
      <td><?= htmlspecialchars($rdv['medecin_prenom'] ?? '') ?></td>
      <td><?= htmlspecialchars($rdv['specialite'] ?? '') ?></td>
      <td><?= $rdv['date_rdv'] ?></td>
      <td><?= htmlspecialchars($rdv['motif'] ?? '') ?></td>
      <td><?= htmlspecialchars($rdv['statut'] ?? '') ?></td>
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
