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
// Activer l'affichage des erreurs pour le débogage ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1); error_reporting(E_ALL);
  // Connexion à la base de données
   try { $mysql = new PDO('mysql:host=localhost;dbname=gest_app', 'root', 'lucia');
   $mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); }
    catch (PDOException $e) { die("Erreur de connexion : " . $e->getMessage());
     } $results = []; if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['nom'])) { $nom = htmlspecialchars($_GET['nom']); 
     // Recherche des informations de la personne et des applications associées
      $sql = " SELECT
       personne.nom AS Nom,
        personne.prenom AS Prenom,
         personne.email AS Email, 
         personne.telephone AS Telephone,
          application.nom AS Application,
           application.description AS Description,
       architecture.libelle AS Architecture,
        niveau_couche.libelle AS Niveau_couche,
         mode_deploiement.libelle AS Mode_deploiement 
         
         FROM developper
          JOIN personne ON personne.id = developper.idpers 
          JOIN application ON application.id = developper.idapp 
           JOIN architecture ON application.idarch = architecture.id 
           JOIN niveau_couche ON application.idnicou = niveau_couche.id 
           JOIN mode_deploiement ON application.idmopl = mode_deploiement.id 
           WHERE personne.nom LIKE :nom";
            $stmt = $mysql->prepare($sql);
             $likeNom = "%" . $nom . "%";
              $stmt->bindParam(':nom', $likeNom, PDO::PARAM_STR);
               $stmt->execute();
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                } ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de la Recherche</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .table th, .table td {
            padding: 0.5rem; /* Réduire le padding */
            font-size: 0.875rem; /* Réduire la taille de la police */
            white-space: nowrap; /* Empêcher le texte de passer à la ligne */
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4 text-center">Résultats de la Recherche</h1>
        <?php if (!empty($results)) : ?>
            <table class="table table-striped table-bordered table-hover text-center">
                <thead class="thead-light">
                    <tr>
                        <th class="py-2">Nom</th>
                        <th class="py-2">Prénom</th>
                        <th class="py-2">Email</th>
                        <th class="py-2">Telephone</th>
                        <th class="py-2">Application</th>
                        <th class="py-2">Description</th>
                        <th class="py-2">Architecture</th>
                        <th class="py-2">Niveau_couche</th>
                        <th class="py-2">Mode_deploiement</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $row) : ?>
                        <tr>
                            <td><?= htmlspecialchars($row['Nom']) ?></td>
                            <td><?= htmlspecialchars($row['Prenom']) ?></td>
                            <td><?= htmlspecialchars($row['Email']) ?></td>
                            <td><?= htmlspecialchars($row['Telephone']) ?></td>
                            <td><?= htmlspecialchars($row['Application']) ?></td>
                            <td><?= htmlspecialchars($row['Description']) ?></td>
                            <td><?= htmlspecialchars($row['Architecture']) ?></td>
                            <td><?= htmlspecialchars($row['Niveau_couche']) ?></td>
                            <td><?= htmlspecialchars($row['Mode_deploiement']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p class="text-danger text-center">Aucun résultat trouvé pour ce nom.</p>
        <?php endif; ?>
        <a href="voir.php" class="btn btn-secondary btn-block">Retour à la recherche</a> <!-- Bouton Retour à la liste -->
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
