<?php 
include '../entete-dossier.php';
require_once '../paramettre/bd.php'; // Inclure la connexion à la base de données

// Affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<h1 class="fs-5">LISTE DES APPLICATIONS</h1>
<div class="card mt-3">
    <div class="card-body">
        
        <!-- Bouton Ajouter une application -->
        <div class="btn-container">
            <a href="application_manager.php" class="btn-add">Ajouter une application</a>
        </div>

        <!-- Tableau des applications -->
        <div class="table-container">
            <table class="table-list table-striped table-bordered table-sm">
                <thead class="thead-light">
                    <tr>
                        <th class="p-2 bg-table-thead">ID</th>
                        <th class="p-2 bg-table-thead">Nom</th>
                        <th class="p-2 bg-table-thead">Description</th>
                        <th class="p-2 bg-table-thead">Statut</th>
                        <th class="p-2 bg-table-thead">Version</th>
                        <th class="p-2 bg-table-thead">Architecture</th>
                        <th class="p-2 bg-table-thead">Mode de Déploiement</th>
                        <th class="p-2 bg-table-thead">Niveau de Couche</th>
                        <th class="p-2 bg-table-thead">Action</th>
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
                            <td class='px-5 py-2'>" . htmlspecialchars($application['id'] ?? '') . "</td>
                            <td class='px-5 py-2'>" . htmlspecialchars($application['nom'] ?? '') . "</td>
                            <td class='px-5 py-2'>" . htmlspecialchars($application['description'] ?? '') . "</td>
                            <td class='px-5 py-2'>" . htmlspecialchars($application['statut'] ?? '') . "</td>
                            <td class='px-5 py-2'>" . htmlspecialchars($application['version'] ?? '') . "</td>
                            <td class='px-5 py-2'>" . htmlspecialchars($application['architecture'] ?? 'Non défini') . "</td>
                            <td class='px-5 py-2'>" . htmlspecialchars($application['mode_deploiement'] ?? 'Non défini') . "</td>
                            <td class='px-5 py-2'>" . htmlspecialchars($application['niveau_couche'] ?? 'Non défini') . "</td>
                            <td class='action-buttons'>
                                <a href='modificationapp.php?id=" . htmlspecialchars($application['id']) . "' class='btn btn-outline-warning btn-sm px-2 py-1 ' title='Modifier'>
                                    <i class='fas fa-edit fa-xs'></i>
                                </a>
                                <a href='detail_application.php?id=" . htmlspecialchars($application['id']) . "' class='btn btn-outline-danger btn-sm px-2 py-1 ' title='Voir détails'>
                                    <i class='fas fa-trash-alt fa-xs'></i>
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