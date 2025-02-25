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

<div class="row">
    <div class="col-md-12 grid-margin">
    <!--DEBUT DE MON CODE -->

         <div class="container mt-4">
        <h1 class="mb-4">Liste des Personnes et Applications</h1>
        <?php if (count($data) > 0) : ?>
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Telephone</th>
                        <th>Application</th>
                        <th>Architecture</th>
                        <th>Niveau de Couche</th>
                        <th>Mode de Déploiement</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $row) : ?>
                        <tr>
                            <td><?= htmlspecialchars($row['nom_personne']) ?></td>
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
