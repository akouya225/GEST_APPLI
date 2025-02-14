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

// Vérifier si un ID est fourni
if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
    
    // Récupérer les informations de la personne
    $sql = "SELECT nom, prenom, email, telephone FROM personne WHERE id = :id";
    $stmt = $mysql->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $personne = $stmt->fetch(PDO::FETCH_ASSOC);

    // Récupérer les applications développées par la personne
    $sql = "SELECT application.nom AS Application, application.description AS Description_
            FROM developper
            JOIN application ON application.id = developper.idapp
            WHERE developper.idpers = :id";
    $stmt = $mysql->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $applications = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    die("ID non fourni.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la Personne</title>
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
        <h2 class="text-center mb-4">Détails de la Personne</h2>
        <div class="card">
            <div class="card-header bg-primary text-white">
                Informations Personnelles
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Nom:</strong> <?= htmlspecialchars($personne['nom']) ?></li>
                <li class="list-group-item"><strong>Prénom:</strong> <?= htmlspecialchars($personne['prenom']) ?></li>
                <li class="list-group-item"><strong>Email:</strong> <?= htmlspecialchars($personne['email']) ?></li>
                <li class="list-group-item"><strong>Téléphone:</strong> <?= htmlspecialchars($personne['telephone']) ?></li>
            </ul>
        </div>

        <h3 class="mt-4">Applications Développées</h3>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-sm text-center">
                <thead class="thead-light">
                    <tr>
                        <th class="py-2">Application</th>
                        <th class="py-2">Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($applications as $application) {
                        echo "<tr>
                            <td>" . htmlspecialchars($application['Application']) . "</td>
                            <td>" . htmlspecialchars($application['Description_']) . "</td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <a href="personne.php" class="btn btn-secondary mt-3">Retour à la Liste des Personnes</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
