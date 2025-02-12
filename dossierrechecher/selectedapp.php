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

// Charger les options disponibles
$architectures = $mysql->query("SELECT id  FROM architecture")->fetchAll(PDO::FETCH_ASSOC);
$mode_deploiements = $mysql->query("SELECT id  FROM mode_deploiement")->fetchAll(PDO::FETCH_ASSOC);
$niveau_couches = $mysql->query("SELECT id FROM niveau_couche")->fetchAll(PDO::FETCH_ASSOC);

// Tableau de correspondance pour l'architecture
$architecture_labels = [
    1 => 'monolithique',
    2 => 'microservice'
];

// Tableau de correspondance pour le mode de déploiement
$mode_deploiement_labels = [
    1 => 'Serveur',
    2 => 'Container',
    3 => 'Installable'
];

// Tableau de correspondance pour le niveau de couche
$niveau_couche_labels = [
    1 => 'Back-End',
    2 => 'Full-Stack',
    3 => 'Front-End'
];

// Récupérer les données avec jointure
$sql = "
    SELECT
        application.nom AS nom_application,
        application.description,
        application.version,
        application.idarch,
        application.idmopl,
        application.idnicou,
        mode_deploiement.nom AS libelle_mode_deploiement,
        niveau_couche.nom AS libelle_niveau_couche
    FROM
        application
    JOIN
        mode_deploiement ON application.idmopl = mode_deploiement.id
    JOIN
        niveau_couche ON application.idnicou = niveau_couche.id;
";
$stmt = $mysql->prepare($sql);
$stmt->execute();
$applications = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Afficher les résultats
foreach ($applications as $application) {
    echo "<p><strong>Application:</strong> " . htmlspecialchars($application['nom_application']) . "<br>";
    echo "<strong>Description:</strong> " . htmlspecialchars($application['description']) . "<br>";
    echo "<strong>Version:</strong> " . htmlspecialchars($application['version']) . "<br>";
    echo "<strong>Architecture:</strong> " . htmlspecialchars($architecture_labels[$application['idarch']]) . "<br>";
    echo "<strong>Mode de déploiement:</strong> " . htmlspecialchars($mode_deploiement_labels[$application['idmopl']]) . "<br>";
    echo "<strong>Niveau de couche:</strong> " . htmlspecialchars($niveau_couche_labels[$application['idnicou']]) . "<br></p>";
}
?>
