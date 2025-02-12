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
// Connexion à la base de données
try {
    $mysql = new PDO('mysql:host=localhost;dbname=gest_app', 'root', 'lucia');
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
            </form>
        <?php else : ?>
            <p class="text-danger">Aucune donnée trouvée pour cet ID.</p>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
