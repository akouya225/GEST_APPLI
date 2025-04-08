<?php
// Connexion à la base de données
try {
    $mysql = new PDO('mysql:host=localhost;dbname=gest_app', 'root', 'lucia');
    $mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

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
        header("Location: retour.php");
        exit();
    } else {
        $errorInfo = $stmt->errorInfo();
        echo "Erreur lors de l'insertion : " . $errorInfo[2];
    }
}

// Supprimer les données de la table `personne` et les tables dépendantes
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id = htmlspecialchars($_POST['id']);
    // Supprimer les entrées dans la table `developper`z
    $sql = "DELETE FROM developper WHERE idpers = :id";
    $stmt = $mysql->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    // Supprimer l'entrée dans la table `personne`
    $sql = "DELETE FROM personne WHERE id = :id";
    $stmt = $mysql->prepare($sql);
    $stmt->bindParam(':id', $id);
    if ($stmt->execute()) {
        header("Location: retour.php");
        exit();
    } else {
        $errorInfo = $stmt->errorInfo();
        echo "Erreur lors de la suppression : " . $errorInfo[2];
    }
}

// Récupérer les données de la table `personne`
$sql = "SELECT id, nom, prenom, email, telephone, idtypers FROM personne";
$stmt = $mysql->query($sql);
$personnes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
