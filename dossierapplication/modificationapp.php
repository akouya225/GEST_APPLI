<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Akouya Admin</title>
    <?php include 'css.php'; ?>
  </head>
  <body>
    <div class="container-scroller">
      <div class="row p-0 m-0 proBanner" id="proBanner">
        <div class="col-md-12 p-0 m-0">
          <div class="card-body card-body-padding px-3 d-flex align-items-center justify-content-between">
            <div>
              <div class="d-flex align-items-center justify-content-between">
                
                <a href="https://www.bootstrapdash.com/product/skydash-admin-template" target="_blank" class="btn me-2 buy-now-btn border-0"></a>
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <a href="https://www.bootstrapdash.com/product/skydash-admin-template/"><i class="ti-home me-3 text-white"></i></a>
              <button id="bannerClose" class="btn border-0 p-0">
                <i class="ti-close text-white"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- topbar -->
      <?php include 'topbar.php'; ?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?php include 'sidebar.php'; ?>
        
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">






          <?php
// Activer l'affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Connexion à la base de données
try {
    $mysql = new PDO('mysql:host=localhost;dbname=gest_app', 'root', 'lucia');
    $mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Charger les options disponibles
$architectures = $mysql->query("SELECT id  FROM architecture")->fetchAll(PDO::FETCH_ASSOC);
$mode_deploiements = $mysql->query("SELECT id  FROM mode_deploiement")->fetchAll(PDO::FETCH_ASSOC);
$niveau_couches = $mysql->query("SELECT id FROM niveau_couche")->fetchAll(PDO::FETCH_ASSOC);

// Vérifier si une mise à jour est demandée
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = htmlspecialchars($_POST['id']);
    $nom = htmlspecialchars($_POST['nom']);
    $description = htmlspecialchars($_POST['description']);
    $statut = htmlspecialchars($_POST['statut']);
    $version = htmlspecialchars($_POST['version']);
    $idarch = htmlspecialchars($_POST['idarch']); // architecture
    $idmopl = htmlspecialchars($_POST['idmopl']); // mode_deploiement
    $idnicou = htmlspecialchars($_POST['idnicou']); // niveau_couche

    // Vérifier que les valeurs existent dans les tables de référence
    $checkIdArch = $mysql->prepare("SELECT COUNT(*) FROM architecture WHERE id = :id");
    $checkIdArch->bindParam(':id', $id);
    $checkIdArch->execute();
    if ($checkIdArch->fetchColumn() == 0) {
        echo" mise à jour    effectuée";
    }

    $checkIdMoPl = $mysql->prepare("SELECT COUNT(*) FROM mode_deploiement WHERE id = :id");
    $checkIdMoPl->bindParam(':id', $id);
    $checkIdMoPl->execute();
    if ($checkIdMoPl->fetchColumn() == 0) {
        echo" mise à jour    effectuée";
    }

    $checkIdNiCou = $mysql->prepare("SELECT COUNT(*) FROM niveau_couche WHERE id = :id");
    $checkIdNiCou->bindParam(':id', $id);
    $checkIdNiCou->execute();
    if ($checkIdNiCou->fetchColumn() == 0) {
        echo" mise à jour    effectuée";
    }

    // Mettre à jour les données dans la base de données
    $sql = "UPDATE application SET nom = :nom, description = :description, statut = :statut, version = :version, id = :id, id = :id, id = :id WHERE id = :id";
    $stmt = $mysql->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':statut', $statut);
    $stmt->bindParam(':version', $version);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        // Afficher le message de succès avec un bouton retour
        echo "<div class='success-message'>La mise à jour a été effectuée avec succès.
         <a href='application.php' class='back-button'>Retour à la liste</a></div>";
        exit();
    } else {
        $errorInfo = $stmt->errorInfo();
        echo "Erreur lors de la mise à jour : " . $errorInfo[2];
    }
}

// Vérifier si une suppression est demandée
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id = htmlspecialchars($_POST['id']);

    // Supprimer l'entrée de la base de données
    $sql = "DELETE FROM application WHERE id = :id";
    $stmt = $mysql->prepare($sql);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        // Rediriger pour actualiser la page et afficher le message de succès de suppression
        header("Location: modificationapp.php?deleted=true");
        exit();
    } else {
        $errorInfo = $stmt->errorInfo();
        echo "Erreur lors de la suppression : " . $errorInfo[2];
    }
}

// Récupérer les données actuelles pour les afficher dans le formulaire
if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
    $sql = "SELECT * FROM application WHERE id = :id";
    $stmt = $mysql->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $application = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifiez que les données existent
    if (!$application) {
        die("Erreur : Aucune donnée trouvée pour cet ID.");
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'Application</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .form-group label {
            font-size: 0.875rem; /* Réduire la taille de la police */
        }
        .form-control {
            padding: 0.25rem; /* Réduire le padding */
            font-size: 0.875rem; /* Réduire la taille de la police */
        }
        .btn {
            font-size: 0.875rem; /* Réduire la taille de la police */
            padding: 0.5rem 1rem; /* Réduire le padding */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
    <body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Modifier l'Application</h1>
        <?php if (isset($application)) : ?>
            <form action="modificationapp.php" method="POST" class="needs-validation" novalidate>
                <input type="hidden" name="id" value="<?= htmlspecialchars($application['id']) ?>">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" id="nom" value="<?= htmlspecialchars($application['nom']) ?>" class="form-control" required>
                    <div class="invalid-feedback">Veuillez entrer le nom de l'application.</div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" name="description" id="description" value="<?= htmlspecialchars($application['description']) ?>" class="form-control" required>
                    <div class="invalid-feedback">Veuillez entrer la description.</div>
                </div>
                <div class="form-group">
                    <label for="statut">Statut</label>
                    <input type="text" name="statut" id="statut" value="<?= htmlspecialchars($application['statut']) ?>" class="form-control" required>
                    <div class="invalid-feedback">Veuillez entrer le statut.</div>
                </div>
                <div class="form-group">
                    <label for="version">Version</label>
                    <input type="text" name="version" id="version" value="<?= htmlspecialchars($application['version']) ?>" class="form-control" required>
                    <div class="invalid-feedback">Veuillez entrer la version.</div>
                </div>
                <div class="form-group">
                    <label for="idarch">Architecture</label>
                    <select name="idarch" id="idarch" class="form-control" required>
                        <option value="1" <?= $application['idarch'] == 1 ? 'selected' : '' ?>>Monolithique</option>
                        <option value="2" <?= $application['idarch'] == 2 ? 'selected' : '' ?>>Microservice</option>
                    </select>
                    <div class="invalid-feedback">Veuillez choisir une architecture.</div>
                </div>
                <div class="form-group">
                    <label for="idmopl">Mode de Déploiement</label>
                    <select name="idmopl" id="idmopl" class="form-control" required>
                        <option value="1" <?= $application['idmopl'] == 1 ? 'selected' : '' ?>>Serveur</option>
                        <option value="2" <?= $application['idmopl'] == 2 ? 'selected' : '' ?>>Container</option>
                        <option value="3" <?= $application['idmopl'] == 3 ? 'selected' : '' ?>>Installable</option>
                    </select>
                    <div class="invalid-feedback">Veuillez choisir un mode de déploiement.</div>
                </div>
                <div class="form-group">
                    <label for="idnicou">Niveau de Couche</label>
                    <select name="idnicou" id="idnicou" class="form-control" required>
                        <option value="1" <?= $application['idnicou'] == 1 ? 'selected' : '' ?>>Back-End</option>
                        <option value="2" <?= $application['idnicou'] == 2 ? 'selected' : '' ?>>Full-Stack</option>
                        <option value="3" <?= $application['idnicou'] == 3 ? 'selected' : '' ?>>Front-End</option>
                    </select>
                    <div class="invalid-feedback">Veuillez choisir un niveau de couche.</div>
                </div>
                <button type="submit" name="update" class="btn btn-success btn-block">Mettre à jour</button>
                <button type="submit" name="delete" class="btn btn-danger btn-block">Supprimer</button>
                <a href="application.php" class="btn btn-secondary btn-block">Retour à la liste</a>
            </form>
            <?php if (isset($_GET['success']) && $_GET['success'] == 'update') : ?>
                <p class="text-success mt-3">Mise à jour réussie !</p>
            <?php endif; ?>
            <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 'true') : ?>
                <p class="text-success mt-3">Suppression réussie !</p>
            <?php endif; ?>
        <?php else : ?>
            <p class="text-danger">Aucune donnée trouvée pour cet ID.</p>
        <?php endif; ?>
    </div>
</body>


   <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <?php include 'footer.php'; ?>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <?php include 'js.php'; ?>
    
  </body>
</html>