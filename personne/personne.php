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

/* Réduction de la taille des icônes */
.btn-sm i {
    font-size: 10px; /* Taille encore plus réduite des icônes */
}
</style>

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
                                   class='btn btn-outline-primary btn-sm' title='Ajouter une application'>
                                   <i class='fas fa-plus fa-xs'></i></a>

                                <a href='details_personne.php?id=" . htmlspecialchars($personne['id']) . "' 
                                   class='btn btn-outline-info btn-sm' title='Voir les informations'>
                                   <i class='fas fa-eye fa-xs'></i></a>

                                <a href='modifier_personne.php?id=" . htmlspecialchars($personne['id']) . "' 
                                   class='btn btn-outline-warning btn-sm' title='Modifier'>
                                   <i class='fas fa-edit fa-xs'></i></a>

                                <a href='supprimer_personne.php?id=" . htmlspecialchars($personne['id']) . "' 
                                   class='btn btn-outline-danger btn-sm' title='Supprimer'>
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
