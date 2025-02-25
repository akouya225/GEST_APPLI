<?php include '../entete-dossier.php';
require_once '../paramettre/bd.php'; // Inclure la connexion à la base de données
 
// Affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Récupérer les applications sélectionnées
$sql = "SELECT nom FROM selected_applications";
$stmt = $mysql->query($sql);
$selected_apps = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="row">
    <div class="col-md-12 grid-margin">
    <!--DEBUT DE MON CODE -->

    <h2 class="mb-4">Applications Sélectionnées</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-sm text-center">
                <thead class="thead-lighter">
                    <tr>
                        <th class="py-2">Nom</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($selected_apps as $app) {
                        echo "<tr>
                            <td>" . htmlspecialchars($app['nom']) . "</td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <button type="button" class="btn btn-secondary" onclick="location.href=''">Retour</button>
    </div>

        <!--FIN DE MON CODE -->
    </div>
</div>

<?php include '../piedpage.php'; ?>
