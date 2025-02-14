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

// Vérifier si un ID est fourni pour la suppression
if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);

    // Supprimer d'abord les lignes dans la table developper
    $sqlDev = "DELETE FROM developper WHERE idapp IN (SELECT id FROM application WHERE idmopl = :idmopl)";
    $stmtDev = $mysql->prepare($sqlDev);
    $stmtDev->bindParam(':idmopl', $id);

    if ($stmtDev->execute()) {
        // Supprimer ensuite les lignes dans la table application
        $sqlApp = "DELETE FROM application WHERE idmopl = :idmopl";
        $stmtApp = $mysql->prepare($sqlApp);
        $stmtApp->bindParam(':idmopl', $id);

        if ($stmtApp->execute()) {
            // Enfin, supprimer le mode de déploiement
            $sql = "DELETE FROM mode_deploiement WHERE id = :id";
            $stmt = $mysql->prepare($sql);
            $stmt->bindParam(':id', $id);

            if ($stmt->execute()) {
                // Rediriger pour actualiser la page avec un message de succès
                header("Location: mode_deploiement.php?deleted=true");
                exit();
            } else {
                $errorInfo = $stmt->errorInfo();
                echo "Erreur lors de la suppression du mode de déploiement : " . $errorInfo[2];
            }
        } else {
            $errorInfo = $stmtApp->errorInfo();
            echo "Erreur lors de la suppression des applications : " . $errorInfo[2];
        }
    } else {
        $errorInfo = $stmtDev->errorInfo();
        echo "Erreur lors de la suppression des développeurs : " . $errorInfo[2];
    }
} else {
    echo "ID non fourni.";
}
?>
