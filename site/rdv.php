<?php
require_once 'db.php';

$message = "";

// Récupérer la liste des patients et médecins pour le formulaire
$patients = $pdo->query("SELECT id, nom, prenom FROM patients ORDER BY nom")->fetchAll(PDO::FETCH_ASSOC);
$medecins = $pdo->query("SELECT id, nom, prenom FROM medecins ORDER BY nom")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_id = $_POST['patient_id'] ?? null;
    $medecin_id = $_POST['medecin_id'] ?? null;
    $date = $_POST['date_rdv'] ?? '';
    $heure = $_POST['heure_rdv'] ?? '';
    $motif = $_POST['motif'] ?? '';

    // Validation simple
    if (!$patient_id || !$medecin_id || !$date || !$heure) {
        $message = "<div class='alert alert-danger'>❌ Tous les champs obligatoires doivent être remplis.</div>";
    } else {
        // Combiner date + heure en datetime
        $date_rdv = $date . ' ' . $heure . ':00';

        $sql = "INSERT INTO rdv (patient_id, medecin_id, date_rdv, motif, statut) VALUES (?, ?, ?, ?, 'En attente')";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute([$patient_id, $medecin_id, $date_rdv, $motif])) {
            $message = "<div class='alert alert-success'>✅ Rendez-vous enregistré avec succès !</div>";
        } else {
            $message = "<div class='alert alert-danger'>❌ Erreur lors de l’enregistrement du rendez-vous.</div>";
        }
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
      <label for="patient_id" class="form-label">Patient</label>
      <select class="form-select" id="patient_id" name="patient_id" required>
        <option value="">-- Sélectionnez un patient --</option>
        <?php foreach ($patients as $patient): ?>
          <option value="<?= $patient['id'] ?>">
            <?= htmlspecialchars($patient['nom'] . ' ' . $patient['prenom']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="medecin_id" class="form-label">Médecin</label>
      <select class="form-select" id="medecin_id" name="medecin_id" required>
        <option value="">-- Sélectionnez un médecin --</option>
        <?php foreach ($medecins as $medecin): ?>
          <option value="<?= $medecin['id'] ?>">
            <?= htmlspecialchars($medecin['nom'] . ' ' . $medecin['prenom']) ?>
          </option>
        <?php endforeach; ?>
      </select>
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
