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

    // Mettre à jour les lignes dans la table application pour utiliser une autre valeur
    $nouveau_idarch = 1; // Par exemple, 1, ou toute autre valeur valide dans la table architecture
    $sqlApp = "UPDATE application SET idarch = :nouveau_idarch WHERE idarch = :idarch";
    $stmtApp = $mysql->prepare($sqlApp);
    $stmtApp->bindParam(':nouveau_idarch', $nouveau_idarch);
    $stmtApp->bindParam(':idarch', $id);

    if ($stmtApp->execute()) {
        // Ensuite, supprimer l'architecture
        $sql = "DELETE FROM architecture WHERE id = :id";
        $stmt = $mysql->prepare($sql);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            // Rediriger pour actualiser la page avec un message de succès
            header("Location: architecture.php?deleted=true");
            exit();
        } else {
            $errorInfo = $stmt->errorInfo();
            echo "Erreur lors de la suppression de l'architecture : " . $errorInfo[2];
        }
    } else {
        $errorInfo = $stmtApp->errorInfo();
        echo "Erreur lors de la mise à jour des applications : " . $errorInfo[2];
    }
} else {
    echo "ID non fourni.";
}
?>
