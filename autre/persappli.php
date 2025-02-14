<?php
// Connexion à la base de données
try {
    $mysql = new PDO('mysql:host=localhost;dbname=gest_app', 'root', 'lucia');
    $mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Traitement de l'enregistrement des sélections
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['applications'])) {
    ob_start(); // Démarrer la temporisation de sortie
    if (!isset($_POST['id']) || empty($_POST['id'])) {
        die("Erreur : L'ID de la personne n'est pas défini.");
    }
    $id = intval($_POST['id']); // Assurez-vous que l'ID de la personne est fourni

    // Vérifier que l'ID de la personne existe dans la table `personne`
    $sql = "SELECT COUNT(*) FROM personne WHERE id = :id";
    $stmt = $mysql->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    if ($stmt->fetchColumn() == 0) {
        die("Erreur : L'ID de la personne n'existe pas.");
    }

    // Insérer les données sélectionnées dans la table `developper`
    foreach ($_POST['applications'] as $idapp) {
        $sql = "INSERT INTO developper (idpers, idapp) VALUES (:id, :idapp)";
        $stmt = $mysql->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':idapp', $idapp);
        $stmt->execute();
    }

    // Redirection vers la page de liste des applications sélectionnées
    header("Location: developper.php?id=$id");
    ob_end_flush(); // Envoyer la sortie tamponnée et arrêter la temporisation de sortie
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Applications</title>
    <link rel="stylesheet" href="https://stackpath.microsoft.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-4">Liste des Applications</h2>
        <form action="developper.php" method="POST">
            <!-- Ajouter un sélecteur pour choisir la personne -->
            <div class="form-group">
                <label for="id">Sélectionner une Personne</label>
                <select name="id" id="id" class="form-control" required>
                    <?php
                    // Récupérer les données de la table `personne`
                    $sql = "SELECT id, nom FROM personne";
                    $stmt = $mysql->query($sql);
                    $personnes = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($personnes as $personne) {
                        echo "<option value='" . htmlspecialchars($personne['id']) . "'>" . htmlspecialchars($personne['nom']) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-sm text-center">
                    <thead class="thead-lighter">
                        <tr>
                            <th class="py-2">Nom</th>
                            <th class="py-2">Description</th>
                            <th class="py-2">Statut</th>
                            <th class="py-2">Version</th>
                            <th class="py-2">Architecture</th>
                            <th class="py-2">Mode de Déploiement</th>
                            <th class="py-2">Niveau de Couche</th>
                            <th class="py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Récupérer les données de la table `application`
                        $sql = "SELECT id, nom, description, statut, version, idarch, idmopl, idnicou FROM application";
                        $stmt = $mysql->query($sql);
                        $applications = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($applications as $application) {
                            echo "<tr>
                                <td>" . htmlspecialchars($application['nom']) . "</td>
                                <td>" . htmlspecialchars($application['description']) . "</td>
                                <td>" . htmlspecialchars($application['statut']) . "</td>
                                <td>" . htmlspecialchars($application['version']) . "</td>
                                <td>" . htmlspecialchars($application['idarch']) . "</td>
                                <td>" . htmlspecialchars($application['idmopl']) . "</td>
                                <td>" . htmlspecialchars($application['idnicou']) . "</td>
                                <td class='d-flex justify-content-around'>
                                    <input type='checkbox' name='applications[]' value='" . htmlspecialchars($application['id']) . "'>
                                </td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <button type="submit" name="save" class="btn btn-primary   ">Enregistrer Sélection</button>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.microsoft.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
