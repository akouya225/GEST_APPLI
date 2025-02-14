<?php
// Activer l'affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Connexion à la base de données
try {
    $mysql = new PDO('mysql:host=localhost;dbname=gest_app', 'root', 'lucia');
    $mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

$selected_apps = [];
$personne_id = 0;
$personne_nom = '';

// Traitement de l'enregistrement
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['personne_id']) && isset($_POST['applications'])) {
    $personne_id = intval($_POST['personne_id']);
    $applications = $_POST['applications'];

    // Insérer les données dans la table `developper`
    foreach ($applications as $app_id) {
        $sql = "INSERT INTO developper (idpers, idapp) VALUES (:idpers, :idapp)";
        $stmt = $mysql->prepare($sql);
        $stmt->bindParam(':idpers', $personne_id);
        $stmt->bindParam(':idapp', $app_id);
        $stmt->execute();
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

    $message = "La selection  a été effectuée avec succès.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applications Sélectionnées</title>
    <link rel="stylesheet" href="https://stackpath.microsoft.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        
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
        <button type="button" class="btn btn-secondary mt-3" onclick="location.href='personne.php'">Retour</button>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.microsoft.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
