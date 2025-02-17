<?php
          include '../paramettre/hearder.php'; // Inclure l'en-tête
// Inclure le fichier CSS dans la balise <head>
echo '<link rel="stylesheet" href="../css/style.css">'; // Assure-toi que ce fichier existe
?>

             
          <?php
// Connexion à la base de données
// Inclure le fichier de configuration de la connection
require_once '../paramettre/bd.php';

// Récupérer les données actuelles pour les afficher dans le tableau
$sql = "SELECT id, libelle, description FROM type_personne";
$stmt = $mysql->query($sql);
$types = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Types de Personne</title>
    <link rel="stylesheet" href="https://stackpath.microsoft.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="style2.css"> <!-- Lien vers ton fichier CSS -->
   
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4 text-center">La liste des types de personne</h1>
        
        <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 'true') : ?>
            <div class="alert alert-success" role="alert">
                Suppression réussie !
            </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-sm text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Libellé</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($types as $type) {
                        echo "<tr>
                            <td>" . htmlspecialchars($type['id']) . "</td>
                            <td>" . htmlspecialchars($type['libelle']) . "</td>
                            <td>" . htmlspecialchars($type['description']) . "</td>
                            <td class='d-flex justify-content-around'>
                                <a href='modification_typersonne.php?id=" . htmlspecialchars($type['id']) . "' class='btn  btn-sm text-succes' title='Modifier les informations'><i class='fas fa-edit'></i></a>
                                <a href='scriptypers.php?id=" . htmlspecialchars($type['id']) . "' class='btn  btn-sm  text-danger'  title='Supprimer les informations'><i class='fas fa-trash-alt'></i></a>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

   
            
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