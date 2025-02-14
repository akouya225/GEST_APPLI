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
    
    // Supprimer les données de la base de données
    $sql = "DELETE FROM niveau_couche WHERE id = :id";
    $stmt = $mysql->prepare($sql);
    $stmt->bindParam(':id', $id);
    
    if ($stmt->execute()) {
        // Rediriger pour actualiser la page avec un message de succès
        header("Location: liste_niveau_couche.php?deleted=true");
        exit();
    } else {
        $errorInfo = $stmt->errorInfo();
        echo "Erreur lors de la suppression : " . $errorInfo[2];
    }
} else {
    echo "ID non fourni.";
}
?>
