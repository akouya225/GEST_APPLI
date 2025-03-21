
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
<style>
    /* Styles personnalisés */
    
    .table {
        background-color: beige; /* Couleur d'arrière-plan beige */
    }

    .table th, .table td {
        font-size: 15px; /* Réduction de la taille du texte */
    padding: 5px;
    white-space: nowrap; /* Empêche le retour à la ligne */
    border: 1px solid #ddd;
    text-align: center;
    
    }

.table thead th {
    background-color: burlywood; /* Marron foncé */
    color: black; /* Texte blanc pour le contraste */
}

    .table tbody tr:hover {
        background-color: #495057 !important; /* Effet survol */
    }

    .btn i {
        font-size: 1.2rem; /* Agrandir les icônes */
    }

    
</style>

<div class="container mt-5">
    <h1 class="mb-4 text-center">Liste des Niveaux de Couche</h1>

    <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 'true') : ?>
        <div class="alert alert-success" role="alert">
            Suppression réussie !
        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover text-center">
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

<?php include '../piedpage.php'; ?>
