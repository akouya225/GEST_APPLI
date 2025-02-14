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
    
    try {
        // Commencer une transaction
        $mysql->beginTransaction();

        // Supprimer les références dans la table `developper`
        $sql = "DELETE FROM developper WHERE idpers = :id";
        $stmt = $mysql->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Supprimer les données de la table `personne`
        $sql = "DELETE FROM personne WHERE id = :id";
        $stmt = $mysql->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Valider la transaction
        $mysql->commit();
        
        // Rediriger pour actualiser la page avec un message de succès
        header("Location: liste_personne.php?deleted=true");
        exit();
    } catch (PDOException $e) {
        // Annuler la transaction en cas d'erreur
        $mysql->rollBack();
        echo "Erreur lors de la suppression : " . $e->getMessage();
    }
} else {
    echo "ID non fourni.";
}
?>
