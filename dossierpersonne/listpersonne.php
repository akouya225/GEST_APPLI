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







          <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Applications</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .table th, .table td { padding: 0.5rem; /* Réduire le padding */ font-size: 0.875rem; /* Réduire la taille de la police */ white-space: nowrap; /* Empêcher le texte de passer à la ligne */ } /* Style pour les cases à cocher */ .form-check-input { width: 20px; /* Taille de la case */ height: 20px; /* Taille de la case */ border-radius: 5px; /* Bord arrondi */ background-color: #ffffff; /* Couleur de fond par défaut */ border: 2px solid #28a745; /* Bordure verte */ } .form-check-input:checked { background-color: #28a745; /* Couleur de fond verte */ border-color: #28a745; /* Bordure verte */ }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-4 text-center">Liste des Applications</h2>
        <form action="listeapppers.php" method="POST">
            <input type="hidden" name="personne_id" value="<?= htmlspecialchars($_GET['id']) ?>">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover text-center">
                    <thead class="thead-light">
                        <tr>
                            <th class="py-2">Nom</th>
                            <th class="py-2">Description</th>
                            <th class="py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Connexion à la base de données
                        try {
                            $mysql = new PDO('mysql:host=localhost;dbname=gest_app', 'root', 'lucia');
                            $mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $sql = "SELECT id, nom, description, statut, version, idarch, idmopl, idnicou FROM application";
                            $stmt = $mysql->query($sql);
                            $applications = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($applications as $application) {
                                echo "<tr>
                                    <td>" . htmlspecialchars($application['nom']) . "</td>
                                    <td>" . htmlspecialchars($application['description']) . "</td>
                                    
                                    <td>
                                        <div class='form-check'>
                                            <input class='form-check-input' type='checkbox' name='applications[]' value='" . htmlspecialchars($application['id']) . "'>
                                        </div>
                                    </td>
                                </tr>";
                            }
                        } catch (PDOException $e) {
                            die("Erreur de connexion : " . $e->getMessage());
                        }
                        ?>
                    </tbody>
                </table>
                <button type="submit" name="save" class="btn btn-primary btn-block">Enregistrer Sélection</button>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.microsoft.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
