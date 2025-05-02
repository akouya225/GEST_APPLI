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
    $nom = htmlspecialchars($_POST['nom'] ?? '');
    $description = htmlspecialchars($_POST['description'] ?? '');
    $statut = htmlspecialchars($_POST['statut'] ?? '');
    $version = htmlspecialchars($_POST['version'] ?? '');
    $idarch = intval($_POST['idarch'] ?? 0);
    $idmopl = intval($_POST['idmopl'] ?? 0);
    $idnicou = intval($_POST['idnicou'] ?? 0);

    // Vérification que les clés étrangères existent
    $verifArch = $mysql->prepare("SELECT COUNT(*) FROM architecture WHERE id = ?");
    $verifArch->execute([$idarch]);

    $verifMopl = $mysql->prepare("SELECT COUNT(*) FROM mode_deploiement WHERE id = ?");
    $verifMopl->execute([$idmopl]);

    $verifNicou = $mysql->prepare("SELECT COUNT(*) FROM niveau_couche WHERE id = ?");
    $verifNicou->execute([$idnicou]);

    if ($verifArch->fetchColumn() && $verifMopl->fetchColumn() && $verifNicou->fetchColumn()) {
        // Insertion si tout est valide
        $sql = "INSERT INTO application (nom, description, statut, version, arch.id, idmopl, idnicou)
                VALUES (:nom, :description, :statut, :version, :idarch, :idmopl, :idnicou)";
        $stmt = $mysql->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':statut', $statut);
        $stmt->bindParam(':version', $version);
        $stmt->bindParam(':arch.id', $idarch);
        $stmt->bindParam(':idmopl', $idmopl);
        $stmt->bindParam(':idnicou', $idnicou);

        if ($stmt->execute()) {
            echo "<span style='color:green;'>Insertion réussie.</span>";
        } else {
            $errorInfo = $stmt->errorInfo();
            echo "<span style='color:red;'>Erreur lors de l'insertion : " . $errorInfo[2] . "</span>";
        }
    } else {
        echo "<span style='color:red;'>Erreur : architecture, mode de déploiement ou niveau de couche inexistant.</span>";
    }
}

// Supprimer une application
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id = intval($_POST['id']);
    $sql = "DELETE FROM application WHERE id = :id";
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

// Récupérer les applications
$sql = "SELECT id, nom, description, statut, version, idarch, idmopl, idnicou FROM application";
$stmt = $mysql->query($sql);
$applications = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
