


          <?php
          include '../paramettre/hearder.php'; // Inclure l'en-tête
// Inclure le fichier CSS dans la balise <head>
echo '<link rel="stylesheet" href="../css/style.css">'; // Assure-toi que ce fichier existe
?>

            
          <?php
// Connexion à la base de données
require_once '../paramettre/bd.php';

// Récupérer les données actuelles pour les afficher dans le tableau
$sql = "SELECT id, libelle, description FROM mode_deploiement";
$stmt = $mysql->query($sql);
$modes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des personnes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="stylepage.css"> <!-- Lien vers ton fichier CSS -->
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4 text-center">La liste des modes de déploiement</h1>
        
        <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 'true') : ?>
            <div class="alert alert-success" role="alert">
                Suppression réussie !
            </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-sm text-center">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Libellé</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($modes as $mode) {
                        echo "<tr>
                            <td>" . htmlspecialchars($mode['id']) . "</td>
                            <td>" . htmlspecialchars($mode['libelle']) . "</td>
                            <td>" . htmlspecialchars($mode['description']) . "</td>
                            <td class='d-flex justify-content-around'>
                                <a href='modification_mode.php?id=" . htmlspecialchars($mode['id']) . "' class='btn  btn-sm  text-succes' title='Modifier les informations'><i class='fas fa-edit'></i></a>
                                <a href='scripmodedeploi.php?id=" . htmlspecialchars($mode['id']) . "' class='btn  btn-sm text-danger '  title='supprimer les informations'><i class='fas fa-trash-alt'></i></a>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php include '../footer.php'; ?>
    <?php include '../js.php'; ?>
    

</body>
</html>
