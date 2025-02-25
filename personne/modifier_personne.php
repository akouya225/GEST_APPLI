<?php include '../entete-dossier.php';
require_once '../paramettre/bd.php'; // Inclure la connexion à la base de données
 
// Affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


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

<div class="row">
    <div class="col-md-12 grid-margin">
    <!--DEBUT DE MON CODE -->

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
                               
                              
                                <?php if (isset($_GET['updated']) && $_GET['updated'] == 'true') : ?>
                                    <p class="text-success mt-3 text-center">Mise à jour réussie !</p> 
                                    <?php endif; ?>
                                     <?php else : ?>
                                        
                                        <?php endif; ?> 
                                        <a href="personne.php" class="btn btn-secondary mt-3">Retour à la Liste des Personnes</a>
                         </div> </form>

        <!--FIN DE MON CODE -->
    </div>
</div>

<?php include '../piedpage.php'; ?>

 