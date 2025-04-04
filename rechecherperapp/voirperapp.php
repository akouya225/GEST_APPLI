<?php include '../entete-dossier.php';
require_once '../paramettre/bd.php'; // Inclure la connexion à la base de données
 
// Affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Récupérer les informations des personnes et de leurs applications
$sql = "
SELECT 
    personne.nom AS nom_personne,
    personne.prenom AS prenom_personne,
    personne.email AS email_personne,
    personne.telephone As telephone_personne,
    application.nom AS nom_application,
    architecture.libelle AS architecture_libelle,
    niveau_couche.libelle AS niveau_couche_libelle,
    mode_deploiement.libelle AS mode_deploiement_libelle
FROM 
    developper
JOIN 
    personne ON developper.idpers = personne.id
JOIN 
    application ON developper.idapp = application.id
JOIN 
    architecture ON application.idarch = architecture.id
JOIN 
    niveau_couche ON application.idnicou = niveau_couche.id
JOIN 
    mode_deploiement ON application.idmopl = mode_deploiement.id;
";

$stmt = $mysql->query($sql);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<h1 class="fs-5">Liste des Personnes et Applications</h1>
<div class="card mt-3">
    <div class="col-md-12 grid-margin">
    <!--DEBUT DE MON CODE -->

             <div class="card-body">
         
        <?php if (count($data) > 0) : ?>
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th class="p-2 bg-table-thead">Nom</th>
                        <th class="p-2 bg-table-thead">Prénom</th>
                        <th class="p-2 bg-table-thead">Email</th>
                        <th class="p-2 bg-table-thead">Telephone</th>
                        <th class="p-2 bg-table-thead">Application</th>
                        <th class="p-2 bg-table-thead">Architecture</th>
                        <th class="p-2 bg-table-thead">Niveau de Couche</th>
                        <th class="p-2 bg-table-thead">Mode de Déploiement</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $row) : ?>
                        <tr>
                            <td class='p-3'><?= htmlspecialchars($row['nom_personne']) ?></td>
                            <td><?= htmlspecialchars($row['prenom_personne']) ?></td>
                            <td><?= htmlspecialchars($row['email_personne']) ?></td>
                            <td><?= htmlspecialchars($row['telephone_personne']) ?></td>
                            <td><?= htmlspecialchars($row['nom_application']) ?></td>
                            <td><?= htmlspecialchars($row['architecture_libelle']) ?></td>
                            <td><?= htmlspecialchars($row['niveau_couche_libelle']) ?></td>
                            <td><?= htmlspecialchars($row['mode_deploiement_libelle']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p class="text-danger">Aucune donnée trouvée.</p>
        <?php endif; ?>
    </div>

        <!--FIN DE MON CODE -->
    </div>
</div>

<?php include '../piedpage.php'; ?>
