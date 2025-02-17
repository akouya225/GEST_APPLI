<?php
          include '../paramettre/hearder.php'; // Inclure l'en-tête
// Inclure le fichier CSS dans la balise <head>
echo '<link rel="stylesheet" href="../css/style.css">'; // Assure-toi que ce fichier existe
?>

           
    <div class="container mt-4">
        <h2>Inscription d'une Personne</h2>
        
        <?php if (!empty($message)) : ?>
            <div class="alert <?= $success ? 'alert-success' : 'alert-danger' ?>" role="alert">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>
        
        <form action="scrippers.php" method="POST" class="needs-validation" novalidate>
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" class="form-control" placeholder="Nom" required>
                <div class="invalid-feedback">Veuillez entrer le nom.</div>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" id="prenom" name="prenom" class="form-control" placeholder="Prénom" required>
                <div class="invalid-feedback">Veuillez entrer le prénom.</div>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
                <div class="invalid-feedback">Veuillez entrer un email valide.</div>
            </div>
            <div class="form-group">
                <label for="telephone">Téléphone</label>
                <input type="text" id="telephone" name="telephone" class="form-control" placeholder="Téléphone" required>
                <div class="invalid-feedback">Veuillez entrer le numéro de téléphone.</div>
            </div>
            <div class="form-group">
                <label for="idtypers">Type de Personne</label>
                <select id="idtypers" name="idtypers" class="form-control" required>
                    <?php
                    // Connexion à la base de données pour récupérer les types de personne
                    try {
                        // Inclure le fichier de configuration de la connection
require_once '../paramettre/bd.php';
                        $mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $sql = "SELECT id, libelle FROM type_personne";
                        $stmt = $mysql->query($sql);
                        $types = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($types as $type) {
                            echo "<option value='" . htmlspecialchars($type['id']) . "'>" . htmlspecialchars($type['libelle']) . "</option>";
                        }
                    } catch (PDOException $e) {
                        die("Erreur de connexion : " . $e->getMessage());
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Ajouter</button>
            <button type="button" class="btn btn-danger" onclick="location.href='personne.php'">Annuler</button>
        </form>
    </div>



          fin content
            
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          
          <?php include '../footer.php'; ?>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <?php include '../js.php'; ?>
    
  </body>
</html>