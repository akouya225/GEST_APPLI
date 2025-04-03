
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
    text-align: left; /* Alignement du texte à gauche */
    
    }

.table thead th {
    background-color: burlywood; /* Marron foncé */
    color: black; /* Texte blanc pour le contraste */
    text-align: left; /* Alignement du texte à gauche */
    
}

    .table tbody tr:hover {
        background-color: #495057 !important; /* Effet survol */
    }

    .btn i {
        font-size: 1.2rem; /* Agrandir les icônes */
    }

    
</style>

<div class="row">
    <div class="col-md-12 grid-margin">
    <!--DEBUT DE MON CODE -->

    <div class="container mt-4">
        <h1 class="mb-4 text-center">La liste des types de personne</h1>
        
        <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 'true') : ?>
            <div class="alert alert-success" role="alert">
                Suppression réussie !
            </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-sm text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Libellé</th>
                        <th>Description</th>
                        <th>Action</th>
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


