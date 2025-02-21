


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

    <h2 class="mb-4 text-center">Liste des Applications</h2>
        <form action="listeapppers.php" method="POST">
            <input type="hidden" name="personne_id" value="<?= htmlspecialchars($_GET['id']) ?>">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover text-center">
                    <thead class="thead-light">
                        <tr>
                            <th class="py-2">Nom</th>
                            <th class="py-2">Description</th>
                            <th class="py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Connexion à la base de données
                        try {
                            // Inclure le fichier de configuration de la connection
require_once '../paramettre/bd.php';
                            $mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $sql = "SELECT id, nom, description, statut, version, idarch, idmopl, idnicou FROM application";
                            $stmt = $mysql->query($sql);
                            $applications = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($applications as $application) {
                                echo "<tr>
                                    <td>" . htmlspecialchars($application['nom']) . "</td>
                                    <td>" . htmlspecialchars($application['description']) . "</td>
                                    
                                    <td>
                                        <div class='form-check'>
                                            <input class='form-check-input' type='checkbox' name='applications[]' value='" . htmlspecialchars($application['id']) . "'>
                                        </div>
                                    </td>
                                </tr>";
                            }
                        } catch (PDOException $e) {
                            die("Erreur de connexion : " . $e->getMessage());
                        }
                        ?>
                    </tbody>
                </table>
                <button type="submit" name="save" class="btn btn-primary btn-block">Enregistrer Sélection</button>
                <a href="personne.php" class="btn btn-secondary mt-3">Retour à la Liste des Personnes</a>
            </div>
        </form>
    </div>

        <!--FIN DE MON CODE -->
    </div>
</div>

<?php include '../paramettre/piedpage.php'; ?>