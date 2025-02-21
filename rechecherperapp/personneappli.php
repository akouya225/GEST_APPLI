
<div class="row">
    <div class="col-md-12 grid-margin">
    <!--DEBUT DE MON CODE -->

    <h1 class="mb-4">Enregistrement des Informations</h1>
        <form action="voirperapp.php" method="POST" class="needs-validation" novalidate>
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom" class="form-control" required>
                <div class="invalid-feedback">Veuillez entrer le nom de la personne.</div>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" name="prenom" id="prenom" class="form-control" required>
                <div class="invalid-feedback">Veuillez entrer le prénom de la personne.</div>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
                <div class="invalid-feedback">Veuillez entrer l'email.</div>
            </div>
            <div class="form-group">
                <label for="telephone">Telephone</label>
                <input type="telephone" name="telephone" id="telephone" class="form-control" required>
                <div class="invalid-feedback">Veuillez entrer telephone.</div>
            </div>
            <div class="form-group">
                <label for="nom_application">Nom de l'Application</label>
                <input type="text" name="nom_application" id="nom_application" class="form-control" required>
                <div class="invalid-feedback">Veuillez entrer le nom de l'application.</div>
            </div>
            <div class="form-group">
                <label for="architecture">Architecture</label>
                <select name="architecture" id="architecture" class="form-control" required>
                    <?php
                    // Connexion à la base de données pour récupérer les architectures
                    try {
                        $mysql = new PDO('mysql:host=localhost;dbname=gest_app', 'root', 'lucia');
                        $mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $sql = "SELECT id, libelle FROM architecture";
                        $stmt = $mysql->query($sql);
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value=\"" . htmlspecialchars($row['id']) . "\">" . htmlspecialchars($row['libelle']) . "</option>";
                        }
                    } catch (PDOException $e) {
                        die("Erreur de connexion : " . $e->getMessage());
                    }
                    ?>
                </select>
                <div class="invalid-feedback">Veuillez choisir une architecture.</div>
            </div>
            <div class="form-group">
                <label for="niveau_couche">Niveau de Couche</label>
                <select name="niveau_couche" id="niveau_couche" class="form-control" required>
                    <?php
                    // Connexion à la base de données pour récupérer les niveaux de couche
                    try {
                        $sql = "SELECT id, libelle FROM niveau_couche";
                        $stmt = $mysql->query($sql);
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value=\"" . htmlspecialchars($row['id']) . "\">" . htmlspecialchars($row['libelle']) . "</option>";
                        }
                    } catch (PDOException $e) {
                        die("Erreur de connexion : " . $e->getMessage());
                    }
                    ?>
                </select>
                <div class="invalid-feedback">Veuillez choisir un niveau de couche.</div>
            </div>
            <div class="form-group">
                <label for="mode_deploiement">Mode de Déploiement</label>
                <select name="mode_deploiement" id="mode_deploiement" class="form-control" required>
                    <?php
                    // Connexion à la base de données pour récupérer les modes de déploiement
                    try {
                        $sql = "SELECT id, libelle FROM mode_deploiement";
                        $stmt = $mysql->query($sql);
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value=\"" . htmlspecialchars($row['id']) . "\">" . htmlspecialchars($row['libelle']) . "</option>";
                        }
                    } catch (PDOException $e) {
                        die("Erreur de connexion : " . $e->getMessage());
                    }
                    ?>
                </select>
                <div class="invalid-feedback">Veuillez choisir un mode de déploiement.</div>
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>
        <!--FIN DE MON CODE -->
    </div>
</div>

