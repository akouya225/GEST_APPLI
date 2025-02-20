<?php
// Connexion à la base de données
require_once '../paramettre/bd.php'; // Inclure la connexion à la base de données
include '../paramettre/hearder.php'; // Inclure l'en-tête

// Récupérer les données actuelles pour les afficher dans le tableau
$sql = "SELECT id, libelle, description FROM architecture";
$stmt = $mysql->query($sql); // Utilise $mysql pour la connexion
$architectures = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des architectures</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4 text-center">La liste des architectures</h1>
        <a href="ajouterapp.php" class="btn btn-primary mb-3">Ajouter une architecture</a>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-sm text-center">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Libelle</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($architectures as $architecture) : ?>
                        <tr>
                            <td><?= htmlspecialchars($architecture['id']) ?></td>
                            <td><?= htmlspecialchars($architecture['libelle']) ?></td>
                            <td><?= htmlspecialchars($architecture['description']) ?></td>
                            <td>
                                <a href="modificationarch.php?id=<?= htmlspecialchars($architecture['id']) ?>" class="btn btn-sm text-success" title="Modifier les informations"><i class="fas fa-edit"></i></a>
                                <a href="supprimerarch.php?id=<?= htmlspecialchars($architecture['id']) ?>" class="btn btn-sm text-danger" title="Supprimer les informations"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <?php include '../footer.php'; ?>
    <?php include '../js.php'; ?>
    
</body>
</html>
