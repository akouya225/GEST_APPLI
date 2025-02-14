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

// Traitement des données du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $nom_application = htmlspecialchars($_POST['nom_application']);
    $architecture = intval($_POST['architecture']);
    $niveau_couche = intval($_POST['niveau_couche']);
    $mode_deploiement = intval($_POST['mode_deploiement']);

    // Enregistrer les données dans la base de données
    try {
        // Insertion dans la table `personne`
        $sql = "INSERT INTO personne (nom, prenom, email,telephone) VALUES (:nom, :prenom, :email,:telephone)";
        $stmt = $mysql->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->execute();
        $personne_id = $mysql->lastInsertId();

        // Insertion dans la table `application`
        $sql = "INSERT INTO application (nom, idarch, idnicou, idmopl) VALUES (:nom_application, :architecture, :niveau_couche, :mode_deploiement)";
        $stmt = $mysql->prepare($sql);
        $stmt->bindParam(':nom_application', $nom_application);
        $stmt->bindParam(':architecture', $architecture);
        $stmt->bindParam(':niveau_couche', $niveau_couche);
        $stmt->bindParam(':mode_deploiement', $mode_deploiement);
        $stmt->execute();
        $application_id = $mysql->lastInsertId();

        // Insertion dans la table `developper`
        $sql = "INSERT INTO developper (idpers, idapp) VALUES (:personne_id, :application_id)";
        $stmt = $mysql->prepare($sql);
        $stmt->bindParam(':personne_id', $personne_id);
        $stmt->bindParam(':application_id', $application_id);
        $stmt->execute();

        // Rediriger vers la page de confirmation ou d'affichage
        header("Location: voirperapp.php?success=true");
        exit();
    } catch (PDOException $e) {
        die("Erreur lors de l'enregistrement : " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>
    <link rel="stylesheet" href="https://stackpath.microsoft.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        
        <?php if (isset($_GET['success']) && $_GET['success'] == 'true') : ?>
            <div class="alert alert-success">L'enregistrement a été effectué avec succès !</div>
        <?php endif; ?>
    </div>
</body>
</html>






<?php
// Connexion à la base de données
try {
    $mysql = new PDO('mysql:host=localhost;dbname=gest_app', 'root', 'lucia');
    $mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

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

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Personnes et Applications</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
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

    
</body>
</html>
