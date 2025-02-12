
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
                <p class="mb-0 font-weight-medium me-3 buy-now-text">Free 24/7 customer support, updates, and more with this template!</p>
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
             debut content
            
             
             <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrement des Informations</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Enregistrement des Informations</h1>
        <form action="voirperapp.php" method="POST" class="needs-validation" novalidate>
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom" class="form-control" required>
                <div class="invalid-feedback">Veuillez entrer le nom de la personne.</div>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" name="prenom" id="prenom" class="form-control" required>
                <div class="invalid-feedback">Veuillez entrer le prénom de la personne.</div>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
                <div class="invalid-feedback">Veuillez entrer l'email.</div>
            </div>
            <div class="form-group">
                <label for="telephone">Telephone</label>
                <input type="telephone" name="telephone" id="telephone" class="form-control" required>
                <div class="invalid-feedback">Veuillez entrer telephone.</div>
            </div>
            <div class="form-group">
                <label for="nom_application">Nom de l'Application</label>
                <input type="text" name="nom_application" id="nom_application" class="form-control" required>
                <div class="invalid-feedback">Veuillez entrer le nom de l'application.</div>
            </div>
            <div class="form-group">
                <label for="architecture">Architecture</label>
                <select name="architecture" id="architecture" class="form-control" required>
                    <?php
                    // Connexion à la base de données pour récupérer les architectures
                    try {
                        $mysql = new PDO('mysql:host=localhost;dbname=gest_app', 'root', 'lucia');
                        $mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $sql = "SELECT id, libelle FROM architecture";
                        $stmt = $mysql->query($sql);
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value=\"" . htmlspecialchars($row['id']) . "\">" . htmlspecialchars($row['libelle']) . "</option>";
                        }
                    } catch (PDOException $e) {
                        die("Erreur de connexion : " . $e->getMessage());
                    }
                    ?>
                </select>
                <div class="invalid-feedback">Veuillez choisir une architecture.</div>
            </div>
            <div class="form-group">
                <label for="niveau_couche">Niveau de Couche</label>
                <select name="niveau_couche" id="niveau_couche" class="form-control" required>
                    <?php
                    // Connexion à la base de données pour récupérer les niveaux de couche
                    try {
                        $sql = "SELECT id, libelle FROM niveau_couche";
                        $stmt = $mysql->query($sql);
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value=\"" . htmlspecialchars($row['id']) . "\">" . htmlspecialchars($row['libelle']) . "</option>";
                        }
                    } catch (PDOException $e) {
                        die("Erreur de connexion : " . $e->getMessage());
                    }
                    ?>
                </select>
                <div class="invalid-feedback">Veuillez choisir un niveau de couche.</div>
            </div>
            <div class="form-group">
                <label for="mode_deploiement">Mode de Déploiement</label>
                <select name="mode_deploiement" id="mode_deploiement" class="form-control" required>
                    <?php
                    // Connexion à la base de données pour récupérer les modes de déploiement
                    try {
                        $sql = "SELECT id, libelle FROM mode_deploiement";
                        $stmt = $mysql->query($sql);
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value=\"" . htmlspecialchars($row['id']) . "\">" . htmlspecialchars($row['libelle']) . "</option>";
                        }
                    } catch (PDOException $e) {
                        die("Erreur de connexion : " . $e->getMessage());
                    }
                    ?>
                </select>
                <div class="invalid-feedback">Veuillez choisir un mode de déploiement.</div>
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>

   

          fin content
            
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