
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
<h1 class="fs-5">La liste des modes de déploiement</h1>

<div class="card mt-3">
    <div class="card-body">
    <!--DEBUT DE MON CODE -->

    
        
        <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 'true') : ?>
            <div class="alert alert-success" role="alert">
                Suppression réussie !
            </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-sm text-center">
                <thead class="thead-light">
                    <tr>
                        <th class="p-2 bg-table-thead">ID</th>
                        <th class="p-2 bg-table-thead">Libellé</th>
                        <th class="p-2 bg-table-thead">Description</th>
                        <th class="p-2 bg-table-thead">Action</th>
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
                                <a href='modification_mode.php?id=" . htmlspecialchars($mode['id']) . "' class='btn btn-outline-warning btn-sm px-2 py-1 ' title='Modifier les informations'><i class='fas fa-edit fa-xs'></i></a>
                                <a href='scripmodedeploi.php?id=" . htmlspecialchars($mode['id']) . "' class='btn btn-outline-danger btn-sm px-2 py-1 '  title='supprimer les informations'><i class='fas fa-trash-alt fa-xs'></i></a>
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