<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche de Personne</title>
    <link rel="stylesheet" href="https://stackpath.microsoft.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Recherche de Personne</h1>
        <form action="resultat_rechercher.php" method="GET" class="needs-validation" novalidate>
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom" class="form-control" required>
                <div class="invalid-feedback">Veuillez entrer un nom.</div>
            </div>
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </form>
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