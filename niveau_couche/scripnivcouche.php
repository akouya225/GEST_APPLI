<?php
require_once '../paramettre/bd.php'; // Connexion à la base de données

// Affichage des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Vérifier que l'ID est présent dans l'URL
if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);

    // ID de remplacement pour les applications
    $nouveau_idnivcouche = 1;

    try {
        // Démarrer une transaction
        $mysql->beginTransaction();

        // Mettre à jour les applications associées à ce niveau de couche
        $sqlUpdateApp = "UPDATE application SET idnicou = :nouveau_id WHERE idnicou = :ancien_id";
        $stmtUpdate = $mysql->prepare($sqlUpdateApp);
        $stmtUpdate->bindParam(':nouveau_id', $nouveau_idnivcouche);
        $stmtUpdate->bindParam(':ancien_id', $id);
        $stmtUpdate->execute();

        // Supprimer le niveau de couche
        $sqlDelete = "DELETE FROM niveau_couche WHERE id = :id";
        $stmtDelete = $mysql->prepare($sqlDelete);
        $stmtDelete->bindParam(':id', $id);
        $stmtDelete->execute();

        // Valider la transaction
        $mysql->commit();

        // Rediriger avec message
        header("Location: niveau_couche.php?deleted=true");
        exit();
    } catch (PDOException $e) {
        $mysql->rollBack();
        echo "Erreur lors de la suppression : " . $e->getMessage();
    }
} else {
    echo "ID non fourni.";
}
?>
