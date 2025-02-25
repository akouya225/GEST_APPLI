
<?php include '../entete-dossier.php';
require_once '../paramettre/bd.php'; // Inclure la connexion à la base de données


// Récupérer les données actuelles pour les afficher dans le tableau
$sql = "SELECT id, libelle, description FROM architecture";
$stmt = $mysql->query($sql); // Utilise $mysql pour la connexion
$architectures = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<div class="row">
    <div class="col-md-12 grid-margin">
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
                    <?php foreach ($architectures as $architecture): ?>
                        <tr>
                            <td><?= htmlspecialchars($architecture['id']) ?></td>
                            <td><?= htmlspecialchars($architecture['libelle']) ?></td>
                            <td><?= htmlspecialchars($architecture['description']) ?></td>
                            <td>
                                <a href="modificationarch.php?id=<?= htmlspecialchars($architecture['id']) ?>"
                                    class="btn btn-sm text-success" title="Modifier les informations"><i
                                        class="fas fa-edit"></i></a>
                                <a href="supprimerarch.php?id=<?= htmlspecialchars($architecture['id']) ?>"
                                    class="btn btn-sm text-danger" title="Supprimer les informations"><i
                                        class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../piedpage.php'; ?>