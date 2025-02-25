  



<?php include '../entete-dossier.php';
require_once '../paramettre/bd.php'; // Inclure la connexion à la base de données

// Affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<div class="row">
<button type="button" class="right btn-unique" onclick="location.href='ajouter_personne.php'">Ajouter une personne</button>
        <h2 class="mb-4">Liste des Personnes</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-sm text-center">
                <thead class="thead-light">
                    <tr>
                        <th class="py-2">ID</th>
                        <th class="py-2">Nom</th>
                        <th class="py-2">Prénom</th>
                        <th class="py-2">Email</th>
                        <th class="py-2">Téléphone</th>
                        <th class="py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                      <?php
                    // Connexion à la base de données
                    try {
                      // Inclure le fichier de configuration  de la connexion
                        $sql = "SELECT id, nom, prenom, email, telephone FROM personne";
                        $stmt = $mysql->query($sql);
                        $personnes = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($personnes as $personne) {
                            echo "<tr>
                                <td>" . htmlspecialchars($personne['id']) . "</td>
                                <td>" . htmlspecialchars($personne['nom']) . "</td>
                                <td>" . htmlspecialchars($personne['prenom']) . "</td>
                                <td>" . htmlspecialchars($personne['email']) . "</td>
                                <td>" . htmlspecialchars($personne['telephone']) . "</td>
                                
                                <td>
                                    <a href='listpersonne.php?id=" . htmlspecialchars($personne['id']) . "' class='btn  btn-sm' title='Ajouter une application developpée par cette personne'><i class='fas  fa-plus text-primary ' ></i></a>
                                    <a href='details_personne.php?id=" . htmlspecialchars($personne['id']) . "' class='btn  btn-sm' title='Voir les informations personnelles et des applications'><i class='fas fa-eye'></i></a>
                                    <a href='modifier_personne.php?id=" . htmlspecialchars($personne['id']) . "' class='btn  btn-sm' title='Modifier les informations'><i class='fas fa-edit text-secondary'></i></a>
                               <a href='supprimer_personne.php?id=" . htmlspecialchars($personne['id']) . "' class='btn btn-sm' title='Supprimer les informations'><i class='fas fa-trash-alt text-danger'></i></a>
                               </td>
                            </tr>";
                        }
                    } catch (PDOException $e) {
                        die("Erreur de connexion : " . $e->getMessage());
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../piedpage.php'; ?>






