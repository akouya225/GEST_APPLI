
<?php include '../paramettre/entete.php';
require_once '../paramettre/bd.php'; // Inclure la connexion à la base de données

// Affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Récupérer les données actuelles pour les afficher dans le tableau
$sql = "SELECT id, libelle, description FROM niveau_couche";
$stmt = $mysql->query($sql);
$niveaux = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="row">
    <div class="col-md-12 grid-margin">
    <!--DEBUT DE MON CODE -->

    <div class="col-md-10 offset-md-2"> <!-- Ajuster la classe selon la taille de la sidebar -->
                <div class="main-panel">
                    <div class="content-wrapper">
                        <h1 class="mb-4 text-center">La liste des niveaux de couche</h1>
                        
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
                                        <th>Libelle</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($niveaux as $niveau) : ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($niveau['id']); ?></td>
                                            <td><?php echo htmlspecialchars($niveau['libelle']); ?></td>
                                            <td><?php echo htmlspecialchars($niveau['description']); ?></td>
                                            <td class='d-flex justify-content-around'>
                                                <a href='modification_couche.php?id=<?php echo htmlspecialchars($niveau['id']); ?>' class='btn btn-sm text-success' title='Modifier les informations'>
                                                    <i class='fas fa-edit'></i>
                                                </a>
                                                <a href='scripnivcouche.php?id=<?php echo htmlspecialchars($niveau['id']); ?>' class='btn btn-sm text-danger' title='Supprimer les informations'>
                                                    <i class='fas fa-trash-alt'></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!--FIN DE MON CODE -->
    </div>
</div>

<?php include '../paramettre/piedpage.php'; ?>
