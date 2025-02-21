


<?php include '../paramettre/entete.php';
require_once '../paramettre/bd.php'; // Inclure la connexion à la base de données

// Affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Vérifie si une mise à jour est demandée
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = htmlspecialchars($_POST['id']);
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $type_personne = htmlspecialchars($_POST['type_personne']);

    // Mettre à jour les données dans la base de données
    $sql = "UPDATE personne SET nom = :nom, prenom = :prenom, email = :email, telephone = :telephone, type_personne = :type_personne WHERE id = :id";
    $stmt = $mysql->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telephone', $telephone);
    $stmt->bindParam(':type_personne', $type_personne);

    if ($stmt->execute()) {
        // Rediriger pour actualiser la page et afficher le message de succès
        echo "  Application  mise à jour : ";
        exit();
    } else {
        $errorInfo = $stmt->errorInfo();
        echo "Erreur lors de la mise à jour : " . $errorInfo[2];
    }
}

// Vérifie si une suppression est demandée
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id = htmlspecialchars($_POST['id']);

    // Supprimer l'entrée de la base de données
    $sql = "DELETE FROM personne WHERE id = :id";
    $stmt = $mysql->prepare($sql);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        // Rediriger pour actualiser la page et afficher le message de succès de suppression
        header("Location: modificationtypepers.php?deleted=true");
        exit();
    } else {
        $errorInfo = $stmt->errorInfo();
        echo "Erreur lors de la suppression : " . $errorInfo[2];
    }
}

// Récupérer les données actuelles pour les afficher dans le formulaire
if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
    $sql = "SELECT * FROM personne WHERE id = :id";
    $stmt = $mysql->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $personne = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifiez que les données existent
    if (!$personne) {
        die("Erreur : Aucune donnée trouvée pour cet ID.");
    }
}?>

<div class="row">
    <div class="col-md-12 grid-margin">
    <!--DEBUT DE MON CODE -->

    <h1 class="mb-4 text-center">Modifier le Type de Personne</h1>
        <?php if (isset($personne)) : ?>
            <form action="modificationtypepers.php" method="POST" class="needs-validation" novalidate>
                <input type="hidden" name="id" value="<?= htmlspecialchars($personne['id']) ?>">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" id="nom" value="<?= htmlspecialchars($personne['nom']) ?>" class="form-control" required>
                    <div class="invalid-feedback">Veuillez entrer le nom.</div>
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="text" name="prenom" id="prenom" value="<?= htmlspecialchars($personne['prenom']) ?>" class="form-control" required>
                    <div class="invalid-feedback">Veuillez entrer le prénom.</div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="<?= htmlspecialchars($personne['email']) ?>" class="form-control" required>
                    <div class="invalid-feedback">Veuillez entrer l'email.</div>
                </div>
                <div class="form-group">
                    <label for="telephone">Téléphone</label>
                    <input type="tel" name="telephone" id="telephone" value="<?= htmlspecialchars($personne['telephone']) ?>" class="form-control" required>
                    <div class="invalid-feedback">Veuillez entrer le téléphone.</div>
                </div>
                <div class="form-group">
                    <label for="type_personne">Type de Personne</label>
                    <select name="type_personne" id="type_personne" class="form-control" required>
                        <option value="1" <?= $personne['type_personne'] == 1 ? 'selected' : '' ?>>Type 1</option>
                        <option value="2" <?= $personne['type_personne'] == 2 ? 'selected' : '' ?>>Type 2</option>
                    </select>
                    <div class="invalid-feedback">Veuillez choisir un type de personne.</div>
                </div>
                <button type="submit" name="update" class="btn btn-success btn-block">Mettre à jour</button>
                <button type="submit" name="delete" class="btn btn-danger btn-block">Supprimer</button>
            </form>
            <?php if (isset($_GET['success']) && $_GET['success'] == 'update') : ?>
                <p class="text-success mt-3 text-center">Mise à jour réussie !</p>
            <?php endif; ?>
            <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 'true') : ?>
                <p class="text-success mt-3 text-center">Suppression réussie !</p>
            <?php endif; ?>
        <?php else : ?>
            <p class="text-danger text-center">Aucune donnée trouvée pour cet ID.</p>
        <?php endif; ?>
    </div>

        <!--FIN DE MON CODE -->
    </div>
</div>

<?php include '../paramettre/piedpage.php'; ?>