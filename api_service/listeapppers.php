
<?php include '../entete-dossier.php';
require_once '../paramettre/bd.php'; // Inclure la connexion à la base de données
 
// Affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$selected_apps = [];
$personne_id = 0;
$personne_nom = '';

// Traitement de l'enregistrement
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['personne_id']) && isset($_POST['applications'])) {
    $personne_id = intval($_POST['personne_id']);
    $applications = $_POST['applications'];

    // Insérer les données dans la table `developper`
    foreach ($applications as $app_id) {
        // Vérification si l'entrée existe déjà
        $checkSql = "SELECT COUNT(*) FROM developper WHERE idpers = :idpers AND idapp = :idapp";
        $checkStmt = $mysql->prepare($checkSql);
        $checkStmt->bindParam(':idpers', $personne_id);
        $checkStmt->bindParam(':idapp', $app_id);
        $checkStmt->execute();
        
        if ($checkStmt->fetchColumn() == 0) { // Si aucune entrée n'existe, insérer
            $sql = "INSERT INTO developper (idpers, idapp) VALUES (:idpers, :idapp)";
            $stmt = $mysql->prepare($sql);
            $stmt->bindParam(':idpers', $personne_id);
            $stmt->bindParam(':idapp', $app_id);
            $stmt->execute();
        }
    }

    // Récupérer le nom de la personne
    $sql = "SELECT nom, prenom FROM personne WHERE id = :id";
    $stmt = $mysql->prepare($sql);
    $stmt->bindParam(':id', $personne_id, PDO::PARAM_INT);
    $stmt->execute();
    $personne = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($personne) {
        $personne_nom = $personne['nom'] . ' ' . $personne['prenom'];
    }

    // Récupérer les applications sélectionnées pour cette personne
    $sql = "
        SELECT application.nom 
        FROM developper
        JOIN application ON application.id = developper.idapp
        WHERE developper.idpers = :id
    ";
    $stmt = $mysql->prepare($sql);
    $stmt->bindParam(':id', $personne_id, PDO::PARAM_INT);
    $stmt->execute();
    $selected_apps = $stmt->fetchAll(PDO::FETCH_COLUMN);

    $message = "La sélection a été effectuée avec succès.";
}

?>

<div class="row">
    <div class="col-md-12 grid-margin">
    <!--DEBUT DE MON CODE -->

    <?php if (!empty($message)) : ?>
            <p><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>
        <h3>Applications sélectionnées :</h3>
        <ul class="list-group">
            <?php
            if (!empty($selected_apps)) {
                foreach ($selected_apps as $app) {
                    echo "<li class='list-group-item'>" . htmlspecialchars($app) . "</li>";
                }
            } else {
                echo "<li class='list-group-item'>Aucune application sélectionnée.</li>";
            }
            ?>
        </ul>
        <button type="button" class="btn btn-secondary mt-3" onclick="location.href='indexpersonne.html'">Retour</button>
    </div>

        <!--FIN DE MON CODE -->
    </div>
</div>

<?php include '../piedpage.php'; ?>
