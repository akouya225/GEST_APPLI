
<?php include '../entete-dossier.php';
require_once '../paramettre/bd.php'; // Inclure la connexion à la base de données
 
// Affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Récupérer les données actuelles pour les afficher dans le tableau
$sql = "SELECT id, libelle, description FROM mode_deploiement";
$stmt = $mysql->query($sql);
$modes = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="row">
    <div class="col-md-12 grid-margin">
    <!--DEBUT DE MON CODE -->

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
</div>

<?php include '../piedpage.php'; ?>