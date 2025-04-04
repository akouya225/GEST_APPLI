
<?php include '../entete-dossier.php';
require_once '../paramettre/bd.php'; // Inclure la connexion à la base de données
 
// Affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Récupérer les données actuelles pour les afficher dans le tableau
$sql = "SELECT id, libelle, description FROM type_personne";
$stmt = $mysql->query($sql);
$types = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<h1 class="fs-5">La liste des types de personnet</h1>


<div class="card mt-3">
    <div class="card-body">
    <div class="col-md-12 grid-margin">
    <!--DEBUT DE MON CODE -->

    <div class="container mt-4">
        
        <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 'true') : ?>
            <div class="alert alert-success" role="alert">
                Suppression réussie !
            </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-sm text-center">
                <thead class="thead-dark">
                    <tr>
                        <th class="p-2 bg-table-thead">ID</th>
                        <th class="p-2 bg-table-thead">Libellé</th>
                        <th class="p-2 bg-table-thead">Description</th>
                        <th class="p-2 bg-table-thead">Action</th>
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

   

        <!--FIN DE MON CODE -->
    </div>
</div>

<?php include '../piedpage.php'; ?>


