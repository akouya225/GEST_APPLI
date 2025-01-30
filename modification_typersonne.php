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

// Vérifie si une mise à jour est demandée
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = htmlspecialchars($_POST['id']);
    $libelle = htmlspecialchars($_POST['libelle']); // Modification spécifique au type de personne

    // Mettre à jour les données dans la base de données
    $sql = "UPDATE type_personne SET libelle = :libelle WHERE id = :id";
    $stmt = $mysql->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':libelle', $libelle);

    if ($stmt->execute()) {
        // Rediriger pour actualiser la page et afficher le message de succès
        echo "<div class='success-message'>La mise à jour a été effectuée avec succès.
        <a href='typepersonne.php' class='back-button'>Retour à la liste</a></div>";
        exit();
    } else {
        $errorInfo = $stmt->errorInfo();
        echo "Erreur lors de la mise à jour : " . $errorInfo[2];
    }
}

// Vérifie si une suppression est demandée
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id = htmlspecialchars($_POST['id']);

    // Supprimer l'entrée de la base de données
    $sql = "DELETE FROM type_personne WHERE id = :id";
    $stmt = $mysql->prepare($sql);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        // Rediriger pour actualiser la page et afficher le message de succès de suppression
        header("Location: modificationtypepers.php?deleted=true");
        exit();
    } else {
        $errorInfo = $stmt->errorInfo();
        echo "Erreur lors de la suppression : " . $errorInfo[2];
    }
}

// Récupérer les données actuelles pour les afficher dans le formulaire
if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
    $sql = "SELECT * FROM type_personne WHERE id = :id";
    $stmt = $mysql->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $type_personne = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifiez que les données existent
    if (!$type_personne) {
        die("Erreur : Aucune donnée trouvée pour cet ID.");
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Type de Personne</title>
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
        .container {
            background-color: #f8f9fa; /* Couleur de fond douce */
            border-radius: 8px; /* Bords arrondis */
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Ombre légère */
        }
        h1 {
            font-size: 1.5rem; /* Taille de police du titre */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="card-title mb-4 text-center">Modifier le Type de Personne</h1>
                <?php if (isset($type_personne)) : ?>
                    <form action="modification_typersonne.php" method="POST" class="needs-validation" novalidate>
                        <input type="hidden" name="id" value="<?= htmlspecialchars($type_personne['id']) ?>">
                        <div class="form-group">
                            <label for="libelle">Libellé</label>
                            <input type="text" name="libelle" id="libelle" value="<?= htmlspecialchars($type_personne['libelle']) ?>" class="form-control" required>
                            <div class="invalid-feedback">Veuillez entrer le libellé.</div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" name="description" id="description" value="<?= htmlspecialchars($type_personne['description']) ?>" class="form-control" required>
                            <div class="invalid-feedback">Veuillez entrer la description.</div>
                        </div>
                        <button type="submit" name="update" class="btn btn-success btn-block">Mettre à jour</button>
                        <button type="submit" name="delete" class="btn btn-danger btn-block">Supprimer</button>
                    </form>
                    <?php if (isset($_GET['success']) && $_GET['success'] == 'update') : ?>
                        <p class="text-success mt-3 text-center">Mise à jour réussie !</p>
                    <?php endif; ?>
                    <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 'true') : ?>
                        <p class="text-success mt-3 text-center">Suppression réussie !</p>
                    <?php endif; ?>
                <?php else : ?>
                    <p class="text-danger text-center">Aucune donnée trouvée pour cet ID.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
