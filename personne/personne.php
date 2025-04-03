<?php 
include '../entete-dossier.php';
require_once '../paramettre/bd.php'; // Inclure la connexion à la base de données

// Affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>




<h1>LISTE DES PERSONNES</h1>
<div class="container mt-5">
    <div class="row mb-4">
        
    <div class="btn-container">
    <button class="btn-add" onclick="location.href='ajouter_personne.php'">
        Ajouter une personne
    </button>
</div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered text-center align-middle">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Connexion à la base de données
                try {
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
                                <a href='listpersonne.php?id=" . htmlspecialchars($personne['id']) . "' 
                                   class='btn btn-outline-primary btn-sm px-2 py-1 ' title='Ajouter une application'>
                                   <i class='fas fa-plus fa-xs '></i></a>

                                <a href='details_personne.php?id=" . htmlspecialchars($personne['id']) . "' 
                                   class='btn btn-outline-info btn-sm  px-2 py-1 ' title='Voir les informations'>
                                   <i class='fas fa-eye fa-xs'></i></a>

                                <a href='modifier_personne.php?id=" . htmlspecialchars($personne['id']) . "' 
                                   class='btn btn-outline-warning btn-sm px-2 py-1 ' title='Modifier'>
                                   <i class='fas fa-edit fa-xs'></i></a>

                                <a href='supprimer_personne.php?id=" . htmlspecialchars($personne['id']) . "' 
                                   class='btn btn-outline-danger btn-sm px-2 py-1 ' title='Supprimer'>
                                   <i class='fas fa-trash-alt fa-xs'></i></a>
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

<?php include '../piedpage.php'; ?>
