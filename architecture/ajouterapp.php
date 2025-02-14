<?php
// Connexion à la base de données
try {
    $mysql = new PDO('mysql:host=localhost;dbname=gest_app', 'root', 'lucia');
    $mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Insérer les données du formulaire dans la table `application`
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nom'])) {
    $nom = isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : '';
    $description = isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '';
    $statut = isset($_POST['statut']) ? htmlspecialchars($_POST['statut']) : '';
    $version = isset($_POST['version']) ? htmlspecialchars($_POST['version']) : '';
    $idarch = isset($_POST['idarch']) ? intval($_POST['idarch']) : '';
    $idmopl = isset($_POST['idmopl']) ? intval($_POST['idmopl']) : '';
    $idnicou = isset($_POST['idnicou']) ? intval($_POST['idnicou']) : '';

    // Vérifier que le niveau de couche existe dans la table `niveau_couche`
    $sql_check = "SELECT COUNT(*) FROM niveau_couche WHERE id = :idnicou";
    $stmt_check = $mysql->prepare($sql_check);
    $stmt_check->bindParam(':idnicou', $idnicou);
    $stmt_check->execute();
    $count = $stmt_check->fetchColumn();

    

    $sql = "INSERT INTO application (nom, description, statut, version, idarch, idmopl, idnicou) VALUES (:nom, :description, :statut, :version, :idarch, :idmopl, :idnicou)";
    $stmt = $mysql->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':statut', $statut);
    $stmt->bindParam(':version', $version);
    $stmt->bindParam(':idarch', $idarch);
    $stmt->bindParam(':idmopl', $idmopl);
    $stmt->bindParam(':idnicou', $idnicou);

    if ($stmt->execute()) {
        echo "Application ajoutée avec succès.";
    } else {
        $errorInfo = $stmt->errorInfo();
        echo "Erreur lors de l'insertion : " . $errorInfo[2];
    }
}

// Supprimer les données de la table `application`
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id = htmlspecialchars($_POST['id']);
    $sql = "DELETE FROM application WHERE id = :id";
    $stmt = $mysql->prepare($sql);
    $stmt->bindParam(':id', $id);
    if ($stmt->execute()) {
        header("Location: retour.php");
    } else {
        $errorInfo = $stmt->errorInfo();
        echo "Erreur lors de la suppression : " . $errorInfo[2];
    }
}

// Récupérer les données de la table `application`
$sql = "SELECT id, nom, description, statut, version, idarch, idmopl, idnicou FROM application";
$stmt = $mysql->query($sql);
$applications = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($stmt->execute()) {
    echo "L'enregistrement dans la table application.";
} else {
    echo "Erreur lors de l'enregistrement dans la table application.";
}
?>



