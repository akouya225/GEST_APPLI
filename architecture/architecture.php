
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
<link rel="stylesheet" href="../css/final.css?v=1.0">

<h1 class="fs-5">Liste des architectures</h1>
<div class="card mt-3">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-sm text-center">
                <thead class="thead-light">
                    <tr>
                        <th class="p-2 bg-table-thead">ID</th>
                        <th class="p-2 bg-table-thead">Libelle</th>
                        <th class="p-2 bg-table-thead">Description</th>
                        <th class="p-2 bg-table-thead">Action</th>
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
                                class='btn btn-outline-warning btn-sm px-2 py-1 ' title="Modifier les informations"><i
                                <i class='fas fa-edit fa-xs'></i></a>
                                <a href="supprimerarch.php?id=<?= htmlspecialchars($architecture['id']) ?>"
                                    class='btn btn-outline-danger btn-sm px-2 py-1 ' title="Supprimer les informations"><i
                                    <i class='fas fa-trash-alt fa-xs'></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<script>
    
</script>

<?php include '../piedpage.php'; ?>