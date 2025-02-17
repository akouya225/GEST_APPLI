<?php
          include '../paramettre/hearder.php'; // Inclure l'en-tête
// Inclure le fichier CSS dans la balise <head>
echo '<link rel="stylesheet" href="../css/style.css">'; // Assure-toi que ce fichier existe
?>


<?php
 // Activer l'affichage des erreurs pour le débogage ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1); error_reporting(E_ALL);
 // Connexion à la base de données 
 // Inclure le fichier de configuration de la connection
require_once '../paramettre/bd.php';

     if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) { $id = htmlspecialchars($_GET['id']); 
     // Récupérer les informations de la personne
      $sql = "SELECT * FROM personne WHERE id = :id"; 
     $stmt = $mysql->prepare($sql);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->execute();
       $personne = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$personne) { die("Erreur : Aucune personne trouvée pour cet ID.");
         } } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) 
         {
            // Mise à jour des informations de la personne
             $id = htmlspecialchars($_POST['id']);
              $nom = htmlspecialchars($_POST['nom']); 
              $prenom = htmlspecialchars($_POST['prenom']);
               $email = htmlspecialchars($_POST['email']); 
               $telephone = htmlspecialchars($_POST['telephone']);
                $sql = "UPDATE personne SET nom = :nom, prenom = :prenom, email = :email, telephone = :telephone WHERE id = :id";
                 $stmt = $mysql->prepare($sql);
                 $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                  $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
                  $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
                   $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                    $stmt->bindParam(':telephone', $telephone, PDO::PARAM_STR);
                    if ($stmt->execute())
                     { echo"la mise à jour des information éffectuée avec sucès";
                     }
                      else { echo "Erreur lors de la mise à jour des informations."; } }
                      ?>

                      <!DOCTYPE html>
                      <html lang="fr">
                         <head> <meta charset="UTF-8">
                       <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Modifier Personne</title>
                         <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
                        </head>
                         <body>
                             <div class="container mt-5">
                             
                              <?php if (isset($personne)) : ?>
                                 <form action="modifier_personne.php" method="POST" class="needs-validation" novalidate>
                                     <input type="hidden" name="id" value="<?= htmlspecialchars($personne['id']) ?>">
                                      <div class="form-group"> 
                                        <label for="nom">Nom</label>
                                       <input type="text" name="nom" id="nom" value="<?= htmlspecialchars($personne['nom']) ?>" class="form-control" required>
                                        <div class="invalid-feedback">Veuillez entrer le nom.</div> 
                                    </div> <div class="form-group"> <label for="prenom">Prénom</label> 
                                    <input type="text" name="prenom" id="prenom" value="<?= htmlspecialchars($personne['prenom']) ?>" class="form-control" required> 
                                    <div class="invalid-feedback">Veuillez entrer le prénom.</div> 
                                </div> <div class="form-group"> <label for="email">Email</label>
                                 <input type="email" name="email" id="email" value="<?= htmlspecialchars($personne['email']) ?>" class="form-control" required> 
                                 <div class="invalid-feedback">Veuillez entrer l'email.</div> </div> 
                                 <div class="form-group"> <label for="telephone">Téléphone</label>
                                  <input type="telephone" name="telephone" id="telephone" value="<?= htmlspecialchars($personne['telephone']) ?>" class="form-control" required> 
                                  <div class="invalid-feedback">Veuillez entrer le téléphone.</div>
                                 </div> 
                                 <button type="submit" class="btn btn-success btn-block">Mettre à jour</button> 
                                
                                </form>
                                 <?php if (isset($_GET['updated']) && $_GET['updated'] == 'true') : ?>
                                     <p class="text-success mt-3 text-center">Mise à jour réussie !</p> 
                                     <?php endif; ?>
                                      <?php else : ?>
                                         
                                         <?php endif; ?> 
                                         <a href="personne.php" class="btn btn-secondary mt-3">Retour à la Liste des Personnes</a>
                          </div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
 <script src="https://stackpath.bootstrap.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
</body>
 </html>