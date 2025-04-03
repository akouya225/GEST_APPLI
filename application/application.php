<?php 
include '../entete-dossier.php';
require_once '../paramettre/bd.php'; // Inclure la connexion à la base de données

// Affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<h1>LISTE DES APPLICATIONS</h1>
<div class="row">
    <div class="col-md-12 grid-margin">
        
        <!-- Bouton Ajouter une application -->
        <div class="btn-container">
            <a href="application_manager.php" class="btn-add">Ajouter une application</a>
        </div>

        <!-- Tableau des applications -->
        <div class="table-container">
            <table class="table-list table-striped table-bordered table-sm">
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
                    // Requête pour récupérer les applications avec les libellés associés
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
                            <td class='action-buttons'>
                                <a href='modificationapp.php?id=" . htmlspecialchars($application['id']) . "' class='text-primary' title='Modifier'>
                                    <i class='fas fa-edit'></i>
                                </a>
                                <a href='detail_application.php?id=" . htmlspecialchars($application['id']) . "' class='text-secondary' title='Voir détails'>
                                    <i class='fas fa-eye'></i>
                                </a>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<?php include '../piedpage.php'; ?>