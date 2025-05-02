<?php
require_once '../paramettre/bd.php'; // Connexion à la base de données

// Affichage des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Vérifie que l'ID est présent dans l'URL
if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);

    // Définir un ID de remplacement valide
    $nouveau_idmopl = 1;

    try {
        // Démarrer une transaction
        $mysql->beginTransaction();

        // Mettre à jour les applications liées
        $sqlUpdateApps = "UPDATE application SET idmopl = :nouveau_idmopl WHERE idmopl = :idmopl";
        $stmtUpdate = $mysql->prepare($sqlUpdateApps);
        $stmtUpdate->bindParam(':nouveau_idmopl', $nouveau_idmopl);
        $stmtUpdate->bindParam(':idmopl', $id);
        $stmtUpdate->execute();

        // Supprimer le mode de déploiement
        $sqlDelete = "DELETE FROM mode_deploiement WHERE id = :id";
        $stmtDelete = $mysql->prepare($sqlDelete);
        $stmtDelete->bindParam(':id', $id);
        $stmtDelete->execute();

        // Valider la transaction
        $mysql->commit();

        // Redirection avec message
        header("Location: mode_deploiement.php?deleted=true");
        exit();
    } catch (PDOException $e) {
        // Annuler la transaction en cas d'erreur
        $mysql->rollBack();
        echo "Erreur lors de la suppression : " . $e->getMessage();
    }
} else {
    echo "ID non fourni pour la suppression.";
}
?>
