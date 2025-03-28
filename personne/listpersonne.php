<?php 
include '../entete-dossier.php'; 
require_once '../paramettre/bd.php'; // Inclure la connexion à la base de données

// Affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<style>
   /* Conteneur du bouton aligné à droite */
.btn-container {
    display: flex;
    justify-content: flex-end; /* Aligner le bouton à droite */
    margin-bottom: 10px;
    width: 100%;
}

/* Style du bouton */
.btn-add {
    background-color: bisque; 
    color: grey;
    padding: 8px 15px;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    border: none;
    cursor: pointer;
    display: inline-block;
}
/* Style du tableau */
.table {
    font-size: 10px; /* Réduction de la taille du texte */
    background-color: beige;
    width: 100%; /* Ajuster la largeur */
}

.table th, .table td {
    padding: 0px; /* Ajustement de l'espacement */
    white-space: nowrap; /* Empêche le retour à la ligne */
    background-color: moccasin;
}
/* Style de l'en-tête du tableau */
.table thead th {
    background-color: burlywood; /* Marron foncé */
    color: white; /* Texte blanc pour le contraste */
}


/* Conteneur du tableau avec défilement sur petit écran */
.table-responsive {
    max-width: 100%;
    overflow-x: auto; /* Permet le défilement sur petit écran */
}


</style>

<div class="row">
    <div class="col-md-12 grid-margin">
        <!--DEBUT DE MON CODE -->
        <h2 class="mb-4 text-center">Liste des Applications</h2>
        
        <form action="listeapppers.php" method="POST">
        
            <?php if (isset($_GET['id'])): ?>
                <input type="hidden" name="personne_id" value="<?= htmlspecialchars($_GET['id']) ?>">
            <?php else: ?>
                <input type="hidden" name="personne_id" value="">
            <?php endif; ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover text-center">
                    <thead class="thead-light">
                        <tr>
                            <th class="py-2">Nom</th>
                            <th class="py-2">Description</th>
                            <th class="py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Connexion à la base de données
                        try {
                            $mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $sql = "SELECT id, nom, description FROM application"; // Enlève les colonnes non utilisées
                            $stmt = $mysql->query($sql);
                            $applications = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($applications as $application) {
                                echo "<tr>
                                    <td>" . htmlspecialchars($application['nom']) . "</td>
                                    <td>" . htmlspecialchars($application['description']) . "</td>
                                    <td>
                                        <div class='form-check'>
                                            <input class='form-check-input' type='checkbox' name='applications[]' value='" . htmlspecialchars($application['id']) . "'>
                                        </div>
                                    </td>
                                </tr>";
                            }
                        } catch (PDOException $e) {
                            die("Erreur de connexion : " . $e->getMessage());
                        }
                        ?>
                    </tbody>
                </table>
                <button type="submit" name="save" class="btn btn-primary btn-block">Enregistrer Sélection</button>
                <a href="personne.php" class="btn btn-secondary mt-3">Retour à la Liste des Personnes</a>
            </div>
        </form>
    </div>
    <!--FIN DE MON CODE -->
</div>

<?php include '../piedpage.php'; ?>
