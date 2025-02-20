<?php
include '../paramettre/hearder.php'; // Inclure l'en-tête

// Connexion à la base de données
require_once '../paramettre/bd.php'; // Inclure la connexion à la base de données

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $libelle = $_POST['nom'];
    $description = $_POST['description'];

    // Préparer et exécuter la requête d'insertion
    $sql = "INSERT INTO architecture (libelle, description) VALUES (:libelle, :description)";
    $stmt = $mysql->prepare($sql);
    $stmt->bindParam(':libelle', $libelle);
    $stmt->bindParam(':description', $description);

    if ($stmt->execute()) {
        // Rediriger vers la liste des architectures avec un message de succès
        header('Location: architecture.php?success=true'); // Changez 'liste_architecture.php' par le nom de votre fichier de liste
        exit();
    } else {
        echo "Erreur lors de l'ajout de l'architecture.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Architecture</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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

        .form-group {
            max-width: 600px;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2>Ajouter une Architecture</h2>
        <?php if (isset($_GET['success']) && $_GET['success'] == 'true') : ?>
            <div class="alert alert-success" role="alert">
                L'architecture a été ajoutée avec succès!
            </div>
        <?php endif; ?>
        <form action="ajouterapp.php" method="POST">
            <div class="form-group">
                <label for="nom">Libelle</label>
                <input type="text" id="nom" name="nom" placeholder="Nom de l'architecture" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" placeholder="Description" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Ajouter</button>
            <button type="button" class="btn btn-secondary" onclick="location.href='architecture.php'">retour</button>
        </form>
    </div>
    <footer>
        <p>&copy; 2025 - Votre Entreprise</p>
    </footer>
</body>
</html>
