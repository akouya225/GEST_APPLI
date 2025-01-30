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

    // Mettre à jour ou supprimer d'abord les lignes dans la table personne
    $sqlPersonne = "DELETE FROM personne WHERE idpers = :idpers";
    $stmtPersonne = $mysql->prepare($sqlPersonne);
    $stmtPersonne->bindParam(':idpers', $id);

    if ($stmtPersonne->execute()) {
        // Ensuite, supprimer le type de personne
        $sql = "DELETE FROM type_personne WHERE id = :id";
        $stmt = $mysql->prepare($sql);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            // Rediriger pour actualiser la page avec un message de succès
            echo "La suppression a été effectuée avec succès.";
            exit();
        } else {
            $errorInfo = $stmt->errorInfo();
            echo "Erreur lors de la suppression du type de personne : " . $errorInfo[2];
        }
    } else {
        $errorInfo = $stmtPersonne->errorInfo();
        echo "Erreur lors de la suppression des personnes : " . $errorInfo[2];
    }
} else {
    echo "ID non fourni.";
}
?>
