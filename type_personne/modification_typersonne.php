

<?php include '../entete-dossier.php';
require_once '../paramettre/bd.php'; // Inclure la connexion à la base de données
 
// Affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Vérifie si une mise à jour est demandée
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = htmlspecialchars($_POST['id']);
    $libelle = htmlspecialchars($_POST['libelle']); // Modification spécifique au type de personne

    // Mettre à jour les données dans la base de données
    $sql = "UPDATE type_personne SET libelle = :libelle WHERE id = :id";
    $stmt = $mysql->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':libelle', $libelle);

    if ($stmt->execute()) {
        // Rediriger pour actualiser la page et afficher le message de succès
        echo "<div class='success-message'>La mise à jour a été effectuée avec succès.
        <a href='typepersonne.php' class='back-button'>Retour à la liste</a></div>";
        exit();
    } else {
        $errorInfo = $stmt->errorInfo();
        echo "Erreur lors de la mise à jour : " . $errorInfo[2];
    }
}

// Vérifie si une suppression est demandée
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id = htmlspecialchars($_POST['id']);

    // Supprimer l'entrée de la base de données
    $sql = "DELETE FROM type_personne WHERE id = :id";
    $stmt = $mysql->prepare($sql);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        // Rediriger pour actualiser la page et afficher le message de succès de suppression
        header("Location: modificationtypepers.php?deleted=true");
        exit();
    } else {
        $errorInfo = $stmt->errorInfo();
        echo "Erreur lors de la suppression : " . $errorInfo[2];
    }
}

// Récupérer les données actuelles pour les afficher dans le formulaire
if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
    $sql = "SELECT * FROM type_personne WHERE id = :id";
    $stmt = $mysql->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $type_personne = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifiez que les données existent
    if (!$type_personne) {
        die("Erreur : Aucune donnée trouvée pour cet ID.");
    }
}

?>

<div class="row">
    <div class="col-md-12 grid-margin">
    <!--DEBUT DE MON CODE -->

                        <h1 class="card-title mb-4 text-center">Modifier le Type de Personne</h1>
                <?php if (isset($type_personne)) : ?>
                    <form action="modification_typersonne.php" method="POST" class="needs-validation" novalidate>
                        <input type="hidden" name="id" value="<?= htmlspecialchars($type_personne['id']) ?>">
                        <div class="form-group">
                            <label for="libelle">Libellé</label>
                            <input type="text" name="libelle" id="libelle" value="<?= htmlspecialchars($type_personne['libelle']) ?>" class="form-control" required>
                            <div class="invalid-feedback">Veuillez entrer le libellé.</div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" name="description" id="description" value="<?= htmlspecialchars($type_personne['description']) ?>" class="form-control" required>
                            <div class="invalid-feedback">Veuillez entrer la description.</div>
                        </div>
                        <button type="submit" name="update" class="btn btn-success btn-block">Mettre à jour</button>
                        <button type="submit" name="delete" class="btn btn-danger btn-block">Supprimer</button>
                        <a href="typepersonne.php" class="btn btn-secondary mt-3">Retour </a>
                    </form>
                    <?php if (isset($_GET['success']) && $_GET['success'] == 'update') : ?>
                        <p class="text-success mt-3 text-center">Mise à jour réussie !</p>
                    <?php endif; ?>
                    <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 'true') : ?>
                        <p class="text-success mt-3 text-center">Suppression réussie !</p>
                    <?php endif; ?>
                <?php else : ?>
                    <p class="text-danger text-center">Aucune donnée trouvée pour cet ID.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
   
    </div>
</div>

<?php include '../piedpage.php'; ?>



