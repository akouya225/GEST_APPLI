<?php
// Connexion à la base de données
try {
    $mysql = new PDO('mysql:host=localhost;dbname=gest_app', 'root', 'lucia');
    $mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Variable pour stocker l'état de l'enregistrement
$success = false;
$message = '';

// Insérer les données du formulaire dans la table `personne`
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nom'])) {
    $nom = isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : '';
    $prenom = isset($_POST['prenom']) ? htmlspecialchars($_POST['prenom']) : '';
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $telephone = isset($_POST['telephone']) ? htmlspecialchars($_POST['telephone']) : '';
    $idtypers = isset($_POST['idtypers']) ? intval($_POST['idtypers']) : '';

    $sql = "INSERT INTO personne (nom, prenom, email, telephone, idtypers) VALUES (:nom, :prenom, :email, :telephone, :idtypers)";
    $stmt = $mysql->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telephone', $telephone);
    $stmt->bindParam(':idtypers', $idtypers);

    if ($stmt->execute()) {
        echo"enregistrement avec succès.";
        $message = "La personne a été ajoutée avec succès.";
    } else {
        $errorInfo = $stmt->errorInfo();
        $message = "Erreur lors de l'insertion : " . $errorInfo[2];
    }
}
?>
