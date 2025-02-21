


<?php include '../paramettre/entete.php';
require_once '../paramettre/bd.php'; // Inclure la connexion à la base de données

// Affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<div class="row">
    <div class="col-md-12 grid-margin">
    <!--DEBUT DE MON CODE -->

    <h1 class="mb-4">La liste des types de personne</h1>
    <div class="table-responsive">
        <table class="table table-striped table-bordered text-center">
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
                // Connexion à la base de données
                try {
                    $mysql = new PDO('mysql:host=localhost;dbname=gest_app', 'root', 'lucia');
                    $mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch (PDOException $e) {
                    die("Erreur de connexion : " . $e->getMessage());
                }

                // Récupérer les données de la table `type_personne`
                $sql = "SELECT id, libelle, description FROM type_personne";
                $stmt = $mysql->query($sql);
                $types = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($types as $type) {
                    echo "<tr>
                        <td>" . htmlspecialchars($type['id']) . "</td>
                        <td>" . htmlspecialchars($type['libelle']) . "</td>
                        <td>" . htmlspecialchars($type['description']) . "</td>
                        <td class='d-flex justify-content-around'>
                            <a href='modificationtypers.php?id=" . htmlspecialchars($type['id']) . "' class='btn btn-white'>Modifier</a>
                            <form action='scriptypers.php' method='POST' style='display:inline;'>
                                <input type='hidden' name='id' value='" . htmlspecialchars($type['id']) . "'>
                                <input type='submit' name='delete' value='Supprimer' class='btn btn-secondary'>
                            </form>
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

<?php include '../paramettre/piedpage.php'; ?>
