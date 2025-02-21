

<?php include '../paramettre/entete.php';
require_once '../paramettre/bd.php'; // Inclure la connexion à la base de données

// Affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<div class="row">
<h1 class="mb-4">Recherche de Personne</h1>
        <form action="resultat_rechercher.php" method="GET" class="needs-validation" novalidate>
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom" class="form-control" required>
                <div class="invalid-feedback">Veuillez entrer un nom.</div>
            </div>
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </form>
</div>

<?php include '../paramettre/piedpage.php'; ?>
