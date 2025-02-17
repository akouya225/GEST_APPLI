<?php
          include '../paramettre/hearder.php'; // Inclure l'en-tête
// Inclure le fichier CSS dans la balise <head>
echo '<link rel="stylesheet" href="../css/style.css">'; // Assure-toi que ce fichier existe
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Personne</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Ajouter une Personne</h2>
        <form action="scrippers.php" method="POST">
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" class="form-control form-control-sm" id="nom" name="nom" placeholder="Nom" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" class="form-control form-control-sm" id="prenom" name="prenom" placeholder="Prénom" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control form-control-sm" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <label for="telephone">Téléphone</label>
                <input type="text" class="form-control form-control-sm" id="telephone" name="telephone" placeholder="Téléphone" required>
            </div>
            <div class="form-group">
                <label for="idtypers">Type de Personne</label>
                <select id="idtypers" name="idtypers" class="form-control form-control-sm" required>
                    <?php
                    // Connexion à la base de données pour récupérer les types de personne
                    // Inclure le fichier de configuration de la connection
require_once '../paramettre/bd.php';

                    // Récupérer les types de personne
                    $sql = "SELECT id, libelle FROM type_personne";
                    $stmt = $mysql->query($sql);
                    $types = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($types as $type) {
                        echo "<option value='" . htmlspecialchars($type['id']) . "'>" . htmlspecialchars($type['libelle']) . "</option>";
                    }   
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success btn-sm">Ajouter</button>
            <button type="button" class="btn btn-danger btn-sm" onclick="location.href='personne.php'">Annuler</button>
        </form>
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
