<?php
include '../paramettre/hearder.php'; // Inclure l'en-tête
// Inclure le fichier CSS dans la balise <head>
echo '<link rel="stylesheet" href="../css/style.css">'; // Assure-toi que ce fichier existe
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Applications</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="style2.css"> <!-- Lien vers ton fichier CSS -->
</head>
<body>
    <header>
        <h2>Liste des Applications</h2>
    </header>
    <div class="container mt-4">
        <a href="application_manager.php" class="btn-add">Ajouter une application</a>
        <div class="table-container">
            <table class="table-list table-striped table-bordered table-sm text-center">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Statut</th>
                        <th>Version</th>
                        <th>Architecture</th>
                        <th>Mode de Déploiement</th>
                        <th>Niveau de Couche</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Inclure le fichier de configuration de la connexion
                    require_once '../paramettre/bd.php';
                    
                    // Récupérer les données avec les libellés des tables associées et éviter les NULL
                    $sql = "SELECT 
                                app.id, 
                                app.nom, 
                                app.description, 
                                app.statut, 
                                app.version, 
                                COALESCE(arch.libelle, 'Non défini') AS architecture, 
                                COALESCE(mode.libelle, 'Non défini') AS mode_deploiement, 
                                COALESCE(niveau.libelle, 'Non défini') AS niveau_couche
                            FROM application AS app
                            LEFT JOIN architecture AS arch ON app.idarch = arch.id
                            LEFT JOIN mode_deploiement AS mode ON app.idmopl = mode.id
                            LEFT JOIN niveau_couche AS niveau ON app.idnicou = niveau.id";
                    
                    $stmt = $mysql->query($sql);
                    $applications = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    
                    foreach ($applications as $application) {
                        echo "<tr>
                            <td>" . htmlspecialchars($application['id'] ?? '') . "</td>
                            <td>" . htmlspecialchars($application['nom'] ?? '') . "</td>
                            <td>" . htmlspecialchars($application['description'] ?? '') . "</td>
                            <td>" . htmlspecialchars($application['statut'] ?? '') . "</td>
                            <td>" . htmlspecialchars($application['version'] ?? '') . "</td>
                            <td>" . htmlspecialchars($application['architecture'] ?? 'Non défini') . "</td>
                            <td>" . htmlspecialchars($application['mode_deploiement'] ?? 'Non défini') . "</td>
                            <td>" . htmlspecialchars($application['niveau_couche'] ?? 'Non défini') . "</td>
                            <td class='d-flex'>
                                <a href='modificationapp.php?id=" . htmlspecialchars($application['id']) . "' class='btn btn-sm text-primary ' title='Modifier'><i class='fas fa-edit'></i></a>
                                <a href='detail_application.php?id=" . htmlspecialchars($application['id']) . "' class='btn  btn-sm text-secondary ' title='Voir détails'><i class='fas fa-eye'></i></a>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php include '../footer.php'; ?>
    <?php include '../js.php'; ?>
</body>
</html>
