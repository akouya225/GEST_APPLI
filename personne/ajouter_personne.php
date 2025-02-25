
<?php include '../entete-dossier.php';
require_once '../paramettre/bd.php'; // Inclure la connexion à la base de données
 
// Affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<div class="row">
    <div class="col-md-12 grid-margin">
    <!--DEBUT DE MON CODE -->

    <h2>Ajouter une Personne</h2>
        <form action="scrippers.php" method="POST">
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" class="form-control form-control-sm" id="nom" name="nom" placeholder="Nom" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" class="form-control form-control-sm" id="prenom" name="prenom" placeholder="Prénom" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control form-control-sm" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <label for="telephone">Téléphone</label>
                <input type="text" class="form-control form-control-sm" id="telephone" name="telephone" placeholder="Téléphone" required>
            </div>
            <div class="form-group">
                <label for="idtypers">Type de Personne</label>
                <select id="idtypers" name="idtypers" class="form-control form-control-sm" required>
                    <?php
                    // Connexion à la base de données pour récupérer les types de personne
                    // Inclure le fichier de configuration de la connection
            

                    // Récupérer les types de personne
                    $sql = "SELECT id, libelle FROM type_personne";
                    $stmt = $mysql->query($sql);
                    $types = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($types as $type) {
                        echo "<option value='" . htmlspecialchars($type['id']) . "'>" . htmlspecialchars($type['libelle']) . "</option>";
                    }   
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success btn-sm">Ajouter</button>
            <button type="button" class="btn btn-danger btn-sm" onclick="location.href='personne.php'">Annuler</button>
            <a href="personne.php" class="btn btn-secondary mt-3">Retour à la Liste des Personnes</a>
        </form>
    </div>
    
        <!--FIN DE MON CODE -->
    </div>
</div>

<?php include '../piedpage.php'; ?>




