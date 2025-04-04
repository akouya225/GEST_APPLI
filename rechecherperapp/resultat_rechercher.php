
<?php 
//Affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

 include '../entete-dossier.php';
require_once '../paramettre/bd.php'; // Inclure la connexion à la base de données
 
try{  
$mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); }
    catch (PDOException $e) { die("Erreur de connexion : " . $e->getMessage());
     } $results = []; if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['nom'])) { $nom = htmlspecialchars($_GET['nom']); 
     // Recherche des informations de la personne et des applications associées
      $sql = " SELECT
       personne.nom AS Nom,
        personne.prenom AS Prenom,
         personne.email AS Email, 
         personne.telephone AS Telephone,
          application.nom AS Application,
           application.description AS Description,
       architecture.libelle AS Architecture,
        niveau_couche.libelle AS Niveau_couche,
         mode_deploiement.libelle AS Mode_deploiement 
         
         FROM developper
          JOIN personne ON personne.id = developper.idpers 
          JOIN application ON application.id = developper.idapp 
           JOIN architecture ON application.idarch = architecture.id 
           JOIN niveau_couche ON application.idnicou = niveau_couche.id 
           JOIN mode_deploiement ON application.idmopl = mode_deploiement.id 
           WHERE personne.nom LIKE :nom";
            $stmt = $mysql->prepare($sql);
             $likeNom = "%" . $nom . "%";
              $stmt->bindParam(':nom', $likeNom, PDO::PARAM_STR);
               $stmt->execute();
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                } 


?>
<h1 class="fs-5">Résultats dela Recherche</h1>
 
<div class="card mt-3">
    <div class="card-body">
    <!--DEBUT DE MON CODE -->

        <?php if (!empty($results)) : ?>
            <table class="table table-striped table-bordered table-hover text-center">
                <thead class="thead-light">
                    <tr>
                        <th class="p-2 bg-table-thead">Nom</th>
                        <th class="p-2 bg-table-thead">Prénom</th>
                        <th class="p-2 bg-table-thead">Email</th>
                        <th class="p-2 bg-table-thead">Telephone</th>
                        <th class="p-2 bg-table-thead">Application</th>
                        <th class="p-2 bg-table-thead">Description</th>
                        <th class="p-2 bg-table-thead">Architecture</th>
                        <th class="p-2 bg-table-thead">Niveau_couche</th>
                        <th class="p-2 bg-table-thead">Mode_deploiement</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $row) : ?>
                        <tr>
                            <td class='p-3'><?= htmlspecialchars($row['Nom']) ?></td>
                            <td><?= htmlspecialchars($row['Prenom']) ?></td>
                            <td><?= htmlspecialchars($row['Email']) ?></td>
                            <td><?= htmlspecialchars($row['Telephone']) ?></td>
                            <td><?= htmlspecialchars($row['Application']) ?></td>
                            <td><?= htmlspecialchars($row['Description']) ?></td>
                            <td><?= htmlspecialchars($row['Architecture']) ?></td>
                            <td><?= htmlspecialchars($row['Niveau_couche']) ?></td>
                            <td><?= htmlspecialchars($row['Mode_deploiement']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p class="text-danger text-center">Aucun résultat trouvé pour ce nom.</p>
        <?php endif; ?>
        <a href="voir.php" class="btn btn-secondary btn-block">Retour à la recherche</a> <!-- Bouton Retour à la liste -->
    </div>

        <!--FIN DE MON CODE -->
    </div>
</div>

<?php include '../piedpage.php'; ?>
