<?php 
include '../entete-dossier.php';
require_once '../paramettre/bd.php'; // Inclure la connexion à la base de données

// Affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Charger les options disponibles dynamiquement
$architectures = $mysql->query("SELECT id, libelle FROM architecture")->fetchAll(PDO::FETCH_ASSOC);
$mode_deploiements = $mysql->query("SELECT id, libelle FROM mode_deploiement")->fetchAll(PDO::FETCH_ASSOC);
$niveau_couches = $mysql->query("SELECT id,libelle FROM niveau_couche")->fetchAll(PDO::FETCH_ASSOC);

// Vérifier si une mise à jour est demandée
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = htmlspecialchars($_POST['id']);
    $nom = htmlspecialchars($_POST['nom']);
    $description = htmlspecialchars($_POST['description']);
    $statut = htmlspecialchars($_POST['statut']);
    $version = htmlspecialchars($_POST['version']);
    $idarch = htmlspecialchars($_POST['idarch']);
    $idmopl = htmlspecialchars($_POST['idmopl']);
    $idnicou = htmlspecialchars($_POST['idnicou']);

    // Vérification des clés étrangères
    $valid = true;
    $errors = [];

    foreach ([
        'architecture' => $idarch, 
        'mode_deploiement' => $idmopl, 
        'niveau_couche' => $idnicou
    ] as $table => $value) {
        if ($value <= 0) {
            $errors[] = "Erreur : ID fourni pour $table est invalide.";
            $valid = false;
            continue;
        }

        $query = "SELECT COUNT(*) FROM `$table` WHERE id = :id";
        $check = $mysql->prepare($query);
        $check->bindParam(':id', $value, PDO::PARAM_INT);
        $check->execute();

        if ($check->fetchColumn() == 0) {
            $errors[] = "Erreur : ID $value non trouvé dans la table $table.";
            $valid = false;
        }
    }

    if (!$valid) {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    } else {
        $sql = "UPDATE application SET nom = :nom, description = :description, statut = :statut, version = :version, idarch = :idarch, idmopl = :idmopl, idnicou = :idnicou WHERE id = :id";
        $stmt = $mysql->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':statut', $statut);
        $stmt->bindParam(':version', $version);
        $stmt->bindParam(':idarch', $idarch);
        $stmt->bindParam(':idmopl', $idmopl);
        $stmt->bindParam(':idnicou', $idnicou);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success text-center'>Mise à jour réussie. <a href='application.php'>Retour</a></div>";
        } else {
            echo "Erreur lors de la mise à jour : " . implode(' ', $stmt->errorInfo());
        }
    }
}

// Récupérer les données actuelles
if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
    $stmt = $mysql->prepare("SELECT * FROM application WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $application = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$application) {
        die("Erreur : Aucune donnée trouvée pour cet ID.");
    }
}
?>

<div class="row">
<h1 class="mb-4 text-center">Modifier l'Application</h1>
    <?php if (isset($application)) : ?>
        <form action="modificationapp.php" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($application['id']) ?>">
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom" value="<?= htmlspecialchars($application['nom']) ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" name="description" id="description" value="<?= htmlspecialchars($application['description']) ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="statut">Statut</label>
                <input type="text" name="statut" id="statut" value="<?= htmlspecialchars($application['statut']) ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="version">Version</label>
                <input type="text" name="version" id="version" value="<?= htmlspecialchars($application['version']) ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="idarch">Architecture</label>
                <select name="idarch" id="idarch" class="form-control" required>
                    <?php foreach ($architectures as $arch): ?>
                        <option value="<?= $arch['id'] ?>" <?= ($application['idarch'] == $arch['id']) ? 'selected' : '' ?>><?= $arch['libelle'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="idmopl">Mode de Déploiement</label>
                <select name="idmopl" id="idmopl" class="form-control" required>
                    <?php foreach ($mode_deploiements as $mode): ?>
                        <option value="<?= $mode['id'] ?>" <?= ($application['idmopl'] == $mode['id']) ? 'selected' : '' ?>><?= $mode['libelle'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="idnicou">Niveau de Couche</label>
                <select name="idnicou" id="idnicou" class="form-control" required>
                    <?php foreach ($niveau_couches as $couche): ?>
                        <option value="<?= $couche['id'] ?>" <?= ($application['idnicou'] == $couche['id']) ? 'selected' : '' ?>><?= $couche['libelle'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" name="update" class="btn btn-success btn-block">Mettre à jour</button>
            <a href="application.php" class="btn btn-secondary btn-block">Retour</a>
        </form>
    <?php else : ?>
        
    <?php endif; ?>
</div>
<?php include '../piedpage.php'; ?>