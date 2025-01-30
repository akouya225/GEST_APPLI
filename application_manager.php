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
                <p class="mb-0 font-weight-medium me-3 buy-now-text"></p>
                <a href="https://www.bootstrapdash.com/product/skydash-admin-template" target="_blank" class="btn me-2 buy-now-btn border-0">Buy Now</a>
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

// Traitement de l'ajout d'application
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST['nom']);
    $description = htmlspecialchars($_POST['description']);
    $statut = htmlspecialchars($_POST['statut']);
    $version = htmlspecialchars($_POST['version']);
    $idarch = htmlspecialchars($_POST['idarch']);
    $idmopl = htmlspecialchars($_POST['idmopl']);
    $idnicou = htmlspecialchars($_POST['idnicou']);

    // Insérer les données dans la base de données
    $sql = "INSERT INTO application (nom, description, statut, version, idarch, idmopl, idnicou) 
            VALUES (:nom, :description, :statut, :version, :idarch, :idmopl, :idnicou)";
    $stmt = $mysql->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':statut', $statut);
    $stmt->bindParam(':version', $version);
    $stmt->bindParam(':idarch', $idarch);
    $stmt->bindParam(':idmopl', $idmopl);
    $stmt->bindParam(':idnicou', $idnicou);

    if ($stmt->execute()) {
        // Rediriger pour afficher le message de succès
        echo"ajout effectué avec succès";
       
    } else {
        $errorInfo = $stmt->errorInfo();
        echo "Erreur lors de l'ajout : " . $errorInfo[2];
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Application</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
        }

        .form-group {
            max-width: 600px; /* Limite la largeur des colonnes */
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2>Ajouter une Application</h2>
        <?php if (isset($_GET['success']) && $_GET['success'] == 'true') : ?>
            <div class="alert alert-success" role="alert">
                L'application a été ajoutée avec succès!
            </div>
        <?php endif; ?>
        <form action="ajouterapp.php" method="POST">
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" placeholder="Nom de l'application" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" id="description" name="description" placeholder="Description" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="statut">Statut</label>
                <input type="text" id="statut" name="statut" placeholder="Statut" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="version">Version</label>
                <input type="text" id="version" name="version" placeholder="Version" class="form-control">
            </div>
            <div class="form-group">
                <label for="idarch">Architecture</label>
                <select name="idarch" id="idarch" class="form-control" required>
                    <option value="Monolytique">Monolytique</option>
                    <option value="Microservice">Microservice</option>
                </select>
            </div>
            <div class="form-group">
                <label for="idmopl">Mode de Déploiement</label>
                <select name="idmopl" id="idmopl" class="form-control" required>
                    <option value="Serveur">Serveur</option>
                    <option value="Containe">Containe</option>
                    <option value="Instalable">Instalable</option>
                </select>
            </div>
            <div class="form-group">
                <label for="idnicou">Niveau de Couche</label>
                <select name="idnicou" id="idnicou" class="form-control" required>
                    <option value="Back-End">Back-End</option>
                    <option value="Full-Stack">Full-Stack</option>
                    <option value="Front-End">Front-End</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Ajouter</button>
            <button type="button" class="btn btn-danger" onclick="location.href='application.php'">Annuler</button>
            <button type="button" class="btn btn-secondary" onclick="location.href='application.php'">retour à la liste</button>
          </form>
    </div>

    <!-- partial:partials/_footer.html -->
    
        <?php include 'footer.php'; ?>
    
    <!-- partial -->
    <!-- container-scroller -->
    <?php include 'js.php'; ?>
</body>
</html>
