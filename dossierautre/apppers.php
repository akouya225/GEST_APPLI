<?php
// Connexion à la base de données
try {
    $mysql = new PDO('mysql:host=localhost;dbname=gest_app', 'root', 'lucia');
    $mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Récupérer l'ID de la personne depuis l'URL
$idpers = isset($_GET['idpers']) ? intval($_GET['idpers']) : '';

// Récupérer les informations des applications développées par cette personne
$sql = "
SELECT 
    personne.nom AS nom_personne,
    personne.prenom AS prenom_personne,
    application.nom AS nom_application
FROM 
    developper
JOIN 
    personne ON developper.idpers = personne.id
JOIN 
    application ON developper.idapp = application.id
WHERE 
    developper.idpers = :idpers;
";

$stmt = $mysql->prepare($sql);
$stmt->bindParam(':idpers', $idpers);
$stmt->execute();
$applications = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Applications</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-4">Applications Développées par <?= htmlspecialchars($applications[0]['nom_personne']) . ' ' . htmlspecialchars($applications[0]['prenom_personne']) ?></h2>
        <?php if (count($applications) > 0) : ?>
            <table class="table table-striped table-bordered table-sm text-center">
                <thead class="thead-light">
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
                    <?php foreach ($applications as $application) : ?>
                        <tr>
                            <td><?= htmlspecialchars($application['nom_application']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>Aucune application trouvée pour cette personne.</p>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
