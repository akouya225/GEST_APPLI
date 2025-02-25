<?php include '../entete-dossier.php';
require_once '../paramettre/bd.php'; // Inclure la connexion à la base de données
 
// Affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



// Vérifier si une mise à jour est demandée
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = htmlspecialchars($_POST['id']);
    $libelle = htmlspecialchars($_POST['libelle']);
    $description = htmlspecialchars($_POST['description']);
    
    // Mettre à jour les données dans la base de données
    $sql = "UPDATE mode_deploiement SET libelle = :libelle, description = :description WHERE id = :id";
    $stmt = $mysql->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':libelle', $libelle);
    $stmt->bindParam(':description', $description);
    
    if ($stmt->execute()) {
        // Afficher le message de succès avec un bouton retour
        echo "<div class='success-message'>La mise à jour a été effectuée avec succès.
        <a href='mode_deploiement.php' class='back-button'>Retour à la liste</a></div>";
        exit();
    } else {
        $errorInfo = $stmt->errorInfo();
        echo "Erreur lors de la mise à jour : " . $errorInfo[2];
    }
}

// Vérifier si une suppression est demandée
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id = htmlspecialchars($_POST['id']);

    // Mettre à jour les lignes dans la table application pour utiliser une autre valeur de idmopl
    $nouveau_idmopl = 1; // Par exemple, 1, ou toute autre valeur valide dans la table mode_deploiement
    $sqlApp = "UPDATE application SET idmopl = :nouveau_idmopl WHERE idmopl = :idmopl";
    $stmtApp = $mysql->prepare($sqlApp);
    $stmtApp->bindParam(':nouveau_idmopl', $nouveau_idmopl);
    $stmtApp->bindParam(':idmopl', $id);

    if ($stmtApp->execute()) {
        // Supprimer l'enregistrement de la base de données
        $sql = "DELETE FROM mode_deploiement WHERE id = :id";
        $stmt = $mysql->prepare($sql);
        $stmt->bindParam(':id', $id);
        
        if ($stmt->execute()) {
            // Rediriger pour actualiser la page avec un message de succès
            header("Location: mode_deploiement.php?deleted=true");
            exit();
        } else {
            $errorInfo = $stmt->errorInfo();
            echo "Erreur lors de la suppression : " . $errorInfo[2];
        }
    } else {
        $errorInfo = $stmtApp->errorInfo();
        echo "Erreur lors de la mise à jour des applications : " . $errorInfo[2];
    }
}

// Récupérer les données actuelles pour les afficher dans le formulaire
if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
    $sql = "SELECT * FROM mode_deploiement WHERE id = :id";
    $stmt = $mysql->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $mode_deploiement = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifiez que les données existent
    if (!$mode_deploiement) {
        die("Erreur : Aucune donnée trouvée pour cet ID.");
    }
}

?>

<div class="row">
<h2>Modifier ou Supprimer un Mode de Déploiement</h2>
        <?php if (isset($_GET['success']) && $_GET['success'] == 'update') : ?>
            <div class="alert alert-success" role="alert">
                Mise à jour réussie !
            </div>
        <?php endif; ?>
        <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 'true') : ?>
            <div class="alert alert-success" role="alert">
                Suppression réussie !
            </div>
        <?php endif; ?>
        <?php if (isset($mode_deploiement)) : ?>
            <form action="modification_mode.php" method="POST" class="needs-validation" novalidate>
                <input type="hidden" name="id" value="<?= htmlspecialchars($mode_deploiement['id']) ?>">
                <div class="form-group">
                    <label for="libelle">Libelle</label>
                    <input type="text" name="libelle" id="libelle" value="<?= htmlspecialchars($mode_deploiement['libelle']) ?>" class="form-control" required>
                    <div class="invalid-feedback">Veuillez entrer le libelle.</div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" name="description" id="description" value="<?= htmlspecialchars($mode_deploiement['description']) ?>" class="form-control" required>
                    <div class="invalid-feedback">Veuillez entrer la description.</div>
                </div>
                <button type="submit" name="update" class="btn btn-success">Mettre à jour</button>
                <button type="submit" name="delete" class="btn btn-danger">Supprimer</button>
                <button type="button" class="btn btn-secondary" onclick="location.href='mode_deploiement.php'">retour</button>
            </form>
        <?php else : ?>
            <p class="text-danger">Aucune donnée trouvée pour cet ID.</p>
        <?php endif; ?>
    </div>
</div>

<?php include '../piedpage.php'; ?>

