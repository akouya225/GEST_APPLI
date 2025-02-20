<?php
          include '../paramettre/hearder.php'; // Inclure l'en-tête
// Inclure le fichier CSS dans la balise <head>
echo '<link rel="stylesheet" href="../css/style.css">'; // Assure-toi que ce fichier existe
?>
 <?php
// Connexion à la base de données
// Connexion à la base de données
require_once '../paramettre/bd.php'; // Inclure la connexion à la base de donnée

// Vérifier si une mise à jour est demandée
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = htmlspecialchars($_POST['id']);
    $libelle = htmlspecialchars($_POST['libelle']);
    $description = htmlspecialchars($_POST['description']);
    
    // Mettre à jour les données dans la base de données
    $sql = "UPDATE architecture SET libelle = :libelle, description = :description WHERE id = :id";
    $stmt = $mysql->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':libelle', $libelle);
    $stmt->bindParam(':description', $description);
    
    if ($stmt->execute()) {
        // Rediriger pour actualiser la page avec un message de succès
        echo "<div class='success-message'>La mise à jour a été effectuée avec succès.
              <a href='architecture.php' class='back-button'>Retour à la liste</a></div>";
        exit();
    } else {
        $errorInfo = $stmt->errorInfo();
        echo "Erreur lors de la mise à jour : " . $errorInfo[2];
    }
}

// Récupérer les données actuelles pour les afficher dans le formulaire
if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
    $sql = "SELECT * FROM architecture WHERE id = :id";
    $stmt = $mysql->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $architecture = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier que les données existent
    if (!$architecture) {
        die("Erreur : Aucune donnée trouvée pour cet ID.");
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'Architecture</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Modifier l'Architecture</h2>
        <?php if (isset($_GET['success']) && $_GET['success'] == 'true') : ?>
            <div class="alert alert-success" role="alert">
                Mise à jour réussie !
            </div>
        <?php endif; ?>
        <?php if (isset($architecture)) : ?>
            <form action="modificationarch.php" method="POST" class="needs-validation" novalidate>
                <input type="hidden" name="id" value="<?= htmlspecialchars($architecture['id']) ?>">
                <div class="form-group">
                    <label for="libelle">Libelle</label>
                    <input type="text" name="libelle" id="libelle" value="<?= htmlspecialchars($architecture['libelle']) ?>" class="form-control" required>
                    <div class="invalid-feedback">Veuillez entrer le libelle.</div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" name="description" id="description" value="<?= htmlspecialchars($architecture['description']) ?>" class="form-control" required>
                    <div class="invalid-feedback">Veuillez entrer la description.</div>
                </div>
                <button type="submit" name="update" class="btn btn-success">Mettre à jour</button>
                <button type="button" class="btn btn-danger" onclick="location.href='architecture.php'">supprimer</button>
                <button type="button" class="btn btn-secondary" onclick="location.href='architecture.php'">retour</button>
              </form>
        <?php else : ?>
            <p class="text-danger">Aucune donnée trouvée pour cet ID.</p>
        <?php endif; ?>
    </div>
    </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <?php include '../footer.php'; ?>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <?php include '../js.php'; ?>
    
  </body>
</html>