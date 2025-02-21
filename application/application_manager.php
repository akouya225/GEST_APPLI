
<?php include '../paramettre/entete.php';
require_once '../paramettre/bd.php'; // Inclure la connexion à la base de données

// Affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Traitement de l'ajout d'application
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST['nom']);
    $description = htmlspecialchars($_POST['description']);
    $statut = htmlspecialchars($_POST['statut']);
    $version = htmlspecialchars($_POST['version']);
    $idarch = htmlspecialchars($_POST['idarch']);
    $idmopl = htmlspecialchars($_POST['idmopl']);
    $idnicou = htmlspecialchars($_POST['idnicou']);

    // Insérer les données dans la base de données
    $sql = "INSERT INTO application (nom, description, statut, version, idarch, idmopl, idnicou) 
            VALUES (:nom, :description, :statut, :version, :idarch, :idmopl, :idnicou)";
    $stmt = $mysql->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':statut', $statut);
    $stmt->bindParam(':version', $version);
    $stmt->bindParam(':idarch', $idarch);
    $stmt->bindParam(':idmopl', $idmopl);
    $stmt->bindParam(':idnicou', $idnicou);

    if ($stmt->execute()) {
        // Rediriger pour afficher le message de succès
        echo"ajout effectué avec succès";
       
    } else {
        $errorInfo = $stmt->errorInfo();
        echo "Erreur lors de l'ajout : " . $errorInfo[2];
    }
}
?>

<div class="row">
        <h2>Ajouter une Application</h2>
        <?php if (isset($_GET['success']) && $_GET['success'] == 'true') : ?>
            <div class="alert alert-success" role="alert">
                L'application a été ajoutée avec succès!
            </div>
        <?php endif; ?>
        <form action="ajouterapp.php" method="POST">
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" placeholder="Nom de l'application" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" id="description" name="description" placeholder="Description" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="statut">Statut</label>
                <input type="text" id="statut" name="statut" placeholder="Statut" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="version">Version</label>
                <input type="text" id="version" name="version" placeholder="Version" class="form-control">
            </div>
            <div class="form-group">
                <label for="idarch">Architecture</label>
                <select name="idarch" id="idarch" class="form-control" required>
                    <option value="Monolytique">Monolytique</option>
                    <option value="Microservice">Microservice</option>
                </select>
            </div>
            <div class="form-group">
                <label for="idmopl">Mode de Déploiement</label>
                <select name="idmopl" id="idmopl" class="form-control" required>
                    <option value="Serveur">Serveur</option>
                    <option value="Containe">Containe</option>
                    <option value="Instalable">Instalable</option>
                </select>
            </div>
            <div class="form-group">
                <label for="idnicou">Niveau de Couche</label>
                <select name="idnicou" id="idnicou" class="form-control" required>
                    <option value="Back-End">Back-End</option>
                    <option value="Full-Stack">Full-Stack</option>
                    <option value="Front-End">Front-End</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Ajouter</button>
            <button type="button" class="btn btn-danger" onclick="location.href='application.php'">Annuler</button>
            <button type="button" class="btn btn-secondary" onclick="location.href='application.php'">retour à la liste</button>
          </form>
    </div>
</div>

<?php include '../paramettre/piedpage.php'; ?>









