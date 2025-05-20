<?php
require_once 'db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    $date = $_POST['date_rdv'] ?? '';
    $heure = $_POST['heure_rdv'] ?? '';
    $motif = $_POST['motif'] ?? '';

    $stmt = $pdo->prepare("INSERT INTO rdv (nom, prenom, date_rdv, heure_rdv, motif) VALUES (?, ?, ?, ?, ?)");
    if ($stmt->execute([$nom, $prenom, $date, $heure, $motif])) {
        $message = "<div class='alert alert-success'>✅ Rendez-vous enregistré avec succès !</div>";
    } else {
        $message = "<div class='alert alert-danger'>❌ Erreur lors de l’enregistrement du rendez-vous.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Prendre un rendez-vous</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<?php include 'header.php'; ?>
  <h1>📅 Prendre un rendez-vous</h1>

  <?= $message ?>

  <form method="post" action="">
    <div class="mb-3">
      <label for="nom" class="form-label">Nom</label>
      <input type="text" class="form-control" id="nom" name="nom" required>
    </div>
    <div class="mb-3">
      <label for="prenom" class="form-label">Prénom</label>
      <input type="text" class="form-control" id="prenom" name="prenom" required>
    </div>
    <div class="mb-3">
      <label for="date_rdv" class="form-label">Date du rendez-vous</label>
      <input type="date" class="form-control" id="date_rdv" name="date_rdv" required>
    </div>
    <div class="mb-3">
      <label for="heure_rdv" class="form-label">Heure du rendez-vous</label>
      <input type="time" class="form-control" id="heure_rdv" name="heure_rdv" required>
    </div>
    <div class="mb-3">
      <label for="motif" class="form-label">Motif</label>
      <textarea class="form-control" id="motif" name="motif" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Valider</button>
    <a href="index.php" class="btn btn-secondary">⬅️ Retour</a>
  </form>
</body>
</html>
