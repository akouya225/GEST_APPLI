
<?php include '../paramettre/entete.php';
require_once '../paramettre/bd.php'; // Inclure la connexion à la base de données

// Affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Connexion à la base de données
try {
  
  $mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Erreur de connexion : " . $e->getMessage());
}

// Vérifier si une mise à jour est demandée
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
  $id = htmlspecialchars($_POST['id']);
  $libelle = htmlspecialchars($_POST['libelle']);
  $description = htmlspecialchars($_POST['description']);
  
  // Mettre à jour les données dans la base de données
  $sql = "UPDATE niveau_couche SET libelle = :libelle, description = :description WHERE id = :id";
  $stmt = $mysql->prepare($sql);
  $stmt->bindParam(':id', $id);
  $stmt->bindParam(':libelle', $libelle);
  $stmt->bindParam(':description', $description);
  
  if ($stmt->execute()) {
      // Rediriger pour actualiser la page avec un message de succès
      echo "la suppression effectué avec succès : ";
      exit();
  } else {
      $errorInfo = $stmt->errorInfo();
      echo "Erreur lors de la mise à jour : " . $errorInfo[2];
  }
}

// Vérifier si une suppression est demandée
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
  $id = htmlspecialchars($_POST['id']);
  
  // Supprimer l'enregistrement de la base de données
  $sql = "DELETE FROM niveau_couche WHERE id = :id";
  $stmt = $mysql->prepare($sql);
  $stmt->bindParam(':id', $id);
  
  if ($stmt->execute()) {
      // Rediriger pour actualiser la page avec un message de succès
     "<div class='success-message'>La mise à jour a été effectuée avec succès.
       <a href='niveau_couche.php' class='back-button'>Retour à la liste</a></div>";
      exit();
  } else {
      $errorInfo = $stmt->errorInfo();
      echo "Erreur lors de la suppression : " . $errorInfo[2];
  }
}

// Récupérer les données actuelles pour les afficher dans le formulaire
if (isset($_GET['id'])) {
  $id = htmlspecialchars($_GET['id']);
  $sql = "SELECT * FROM niveau_couche WHERE id = :id";
  $stmt = $mysql->prepare($sql);
  $stmt->bindParam(':id', $id);
  $stmt->execute();
  $niveau_couche = $stmt->fetch(PDO::FETCH_ASSOC);

  // Vérifiez que les données existent
  if (!$niveau_couche) {
      die("Erreur : Aucune donnée trouvée pour cet ID.");
  }
}
?>

<div class="row">
    <div class="col-md-12 grid-margin">
    <!--DEBUT DE MON CODE -->

    <h2>Modifier ou Supprimer un Niveau de Couche</h2>
        <?php if (isset($_GET['success']) && $_GET['success'] == 'update') : ?>
            <div class="alert alert-success" role="alert">
                Mise à jour réussie !
            </div>
        <?php endif; ?>
        <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 'true') : ?>
            <div class="alert alert-success" role="alert">
                Suppression réussie !
            </div>
        <?php endif; ?>
        <?php if (isset($niveau_couche)) : ?>
            <form action="modification_couche.php" method="POST" class="needs-validation" novalidate>
                <input type="hidden" name="id" value="<?= htmlspecialchars($niveau_couche['id']) ?>">
                <div class="form-group">
                    <label for="libelle">Libelle</label>
                    <input type="text" name="libelle" id="libelle" value="<?= htmlspecialchars($niveau_couche['libelle']) ?>" class="form-control" required>
                    <div class="invalid-feedback">Veuillez entrer le libelle.</div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" name="description" id="description" value="<?= htmlspecialchars($niveau_couche['description']) ?>" class="form-control" required>
                    <div class="invalid-feedback">Veuillez entrer la description.</div>
                </div>
                <button type="submit" name="update" class="btn btn-success">Mettre à jour</button>
                <button type="submit" name="delete" class="btn btn-danger">Supprimer</button>
                <button type="button" class="btn btn-secondary" onclick="location.href='niveau_couche.php'">retour</button>
            </form>
        <?php else : ?>
            <p class="text-danger">Aucune donnée trouvée pour cet ID.</p>
        <?php endif; ?>
    </div>


        <!--FIN DE MON CODE -->
    </div>
</div>

<?php include '../paramettre/piedpage.php'; ?>