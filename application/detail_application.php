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

// Vérifier si un ID d'application est fourni
if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);

    // Récupérer les informations de l'application
    $sql_app = "SELECT nom FROM application WHERE id = :id";
    $stmt_app = $mysql->prepare($sql_app);
    $stmt_app->bindParam(':id', $id);
    $stmt_app->execute();
    $application = $stmt_app->fetch(PDO::FETCH_ASSOC);

    if (!$application) {
        die("Application non trouvée.");
    }

    // Récupérer les informations des personnes ayant travaillé sur l'application
    $sql = "SELECT personne.nom, personne.prenom, personne.email, personne.telephone
            FROM developper
            JOIN personne ON personne.id = developper.idpers
            WHERE developper.idapp = :id";
    $stmt = $mysql->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $personnes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    die("ID de l'application non fourni.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'Application</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .container {
            margin-top: 30px;
        }
        .card {
            margin-bottom: 20px;
        }
        .table th, .table td {
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Détails de l'Application</h2>
        <h3 class="text-center mb-4"><?php echo htmlspecialchars($application['nom']); ?></h3>

        <h3 class="mt-4">Personnes ayant travaillé sur l'application</h3>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-sm text-center">
                <thead class="thead-light">
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($personnes as $personne) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($personne['nom']); ?></td>
                        <td><?php echo htmlspecialchars($personne['prenom']); ?></td>
                        <td><?php echo htmlspecialchars($personne['email']); ?></td>
                        <td><?php echo htmlspecialchars($personne['telephone']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <a href="application.php" class="btn btn-secondary mt-3">Retour à la Liste des applications</a>
    </div>
</body>
</html>
