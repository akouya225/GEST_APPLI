<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Akouya Admin</title>
    <?php include 'css.php'; ?>
  </head>
  <body>
    <div class="container-scroller">
      <div class="row p-0 m-0 proBanner" id="proBanner">
        <div class="col-md-12 p-0 m-0">
          <div class="card-body card-body-padding px-3 d-flex align-items-center justify-content-between">
            <div>
              <div class="d-flex align-items-center justify-content-between">
                
                <a href="https://www.bootstrapdash.com/product/skydash-admin-template" target="_blank" class="btn me-2 buy-now-btn border-0"></a>
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <a href="https://www.bootstrapdash.com/product/skydash-admin-template/"><i class="ti-home me-3 text-white"></i></a>
              <button id="bannerClose" class="btn border-0 p-0">
                <i class="ti-close text-white"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- topbar -->
      <?php include 'topbar.php'; ?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?php include 'sidebar.php'; ?>
        
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">




<?php
 // Activer l'affichage des erreurs pour le débogage ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1); error_reporting(E_ALL);
 // Connexion à la base de données 
 try
  { $mysql = new PDO('mysql:host=localhost;dbname=gest_app', 'root', 'lucia');
   $mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);}
    catch (PDOException $e)
     { die("Erreur de connexion : " . $e->getMessage());
     } 
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