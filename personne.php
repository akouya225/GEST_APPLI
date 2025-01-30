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
    <title>Liste des Personnes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="style.css">

    <style>
        .table th {
            padding: 0.35rem; /* Réduire le padding */
            font-size: 1.5rem; /* Réduire la taille de la police */
            white-space: nowrap; /* Empêcher le texte de passer à la ligne */
            height: 25px; /* Réduire la hauteur des cellules */
            border: 1px solid #ddd; /* Ajouter une bordure pour une meilleure lisibilité */
            background-color: #2980b9; /* Couleur de fond verte */
            color: white; /* Couleur du texte blanche */
        }

        .btn-sm {
            padding: 0.25rem 0.5rem; /* Réduire le padding des boutons */
        }

        .right {
            float: right;
        }

        .btn-unique {
            background-color: #4CAF50; /* Couleur de fond verte */
            color: white; /* Couleur du texte blanche */
            border: none; /* Aucun bord */
            padding: 10px; /* Padding (espacement intérieur) */
            text-align: center; /* Texte centré */
            text-decoration: none; /* Pas de soulignement */
            display: inline-block; /* Affiche en ligne */
            font-size: 16px; /* Taille de la police */
            margin: 4px 2px; /* Espacement extérieur */
            cursor: pointer; /* Curseur en forme de main */
            border-radius: 1px; /* Bords arrondis */
        }

        .btn-unique:hover {
            background-color: #45a049; /* Couleur au survol */
        }
        .table .thead-light th {
    color: #fff;
    background-color: #21a8c0;
}
    </style>
</head>
<body>
    <div class="container mt-4">
        <button type="button" class="right btn-unique" onclick="location.href='ajouter_personne.php'">Ajouter une personne</button>
        <h2 class="mb-4">Liste des Personnes</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-sm text-center">
                <thead class="thead-light">
                    <tr>
                        <th class="py-2">ID</th>
                        <th class="py-2">Nom</th>
                        <th class="py-2">Prénom</th>
                        <th class="py-2">Email</th>
                        <th class="py-2">Téléphone</th>
                        <th class="py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                      <?php
                    // Connexion à la base de données
                    try {
                        $mysql = new PDO('mysql:host=localhost;dbname=gest_app', 'root', 'lucia');
                        $mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $sql = "SELECT id, nom, prenom, email, telephone FROM personne";
                        $stmt = $mysql->query($sql);
                        $personnes = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($personnes as $personne) {
                            echo "<tr>
                                <td>" . htmlspecialchars($personne['id']) . "</td>
                                <td>" . htmlspecialchars($personne['nom']) . "</td>
                                <td>" . htmlspecialchars($personne['prenom']) . "</td>
                                <td>" . htmlspecialchars($personne['email']) . "</td>
                                <td>" . htmlspecialchars($personne['telephone']) . "</td>
                                
                                <td>
                                    <a href='listpersonne.php?id=" . htmlspecialchars($personne['id']) . "' class='btn btn-primary btn-sm' title='Ajouter une application developpée par cette personne'><i class='fas fa-plus' ></i></a>
                                    <a href='details_personne.php?id=" . htmlspecialchars($personne['id']) . "' class='btn btn-pink btn-sm' title='Voir les informations personnelles et des applications'><i class='fas fa-eye'></i></a>
                                    <a href='modifier_personne.php?id=" . htmlspecialchars($personne['id']) . "' class='btn btn-success btn-sm' title='Modifier les informations'><i class='fas fa-edit'></i></a>
                               <a href='supprimer_personne.php?id=" . htmlspecialchars($personne['id']) . "' class='btn btn-danger btn-sm' title='Supprimer les informations'><i class='fas fa-trash-alt'></i></a>
                               </td>
                            </tr>";
                        }
                    } catch (PDOException $e) {
                        die("Erreur de connexion : " . $e->getMessage());
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

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