
<?php include '../entete-dossier.php';

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

<h1 class="fs-5">Liste des Niveaux de Couche</h1>

<div class="card mt-3">
<div class="card-body">
    <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 'true') : ?>
        <div class="alert alert-success" role="alert">
            Suppression réussie !
        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover text-center">
            <thead class="thead-light">
                <tr>
                    <th class="p-2 bg-table-thead">ID</th>
                    <th class="p-2 bg-table-thead">Libelle</th>
                    <th class="p-2 bg-table-thead">Description</th>
                    <th class="p-2 bg-table-thead">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($niveaux as $niveau) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($niveau['id']); ?></td>
                        <td><?php echo htmlspecialchars($niveau['libelle']); ?></td>
                        <td><?php echo htmlspecialchars($niveau['description']); ?></td>
                        <td class="d-flex justify-content-center">
                            <a href='modification_couche.php?id=<?php echo htmlspecialchars($niveau['id']); ?>' class='btn btn-sm btn-outline-success me-1' title='Modifier les informations'>
                                <i class='fas fa-edit'></i>
                            </a>
                            <a href='scripnivcouche.php?id=<?php echo htmlspecialchars($niveau['id']); ?>' class='btn btn-sm btn-outline-danger' title='Supprimer les informations'>
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

<?php include '../piedpage.php'; ?>
