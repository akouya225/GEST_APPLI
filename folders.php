<?php
// Définir les dossiers à créer
$folders = [
    'gest_app/asset',
    'gest_app/bd',
    'gest_app/ccs',
    'gest_app/personne',
    'gest_app/architecture',
    'gest_app/mode_deploiement',
    'gest_app/niveau_couche',
    'gest_app/type_personne',
    'gest_app/rechercherapp'
];

// Créer les dossiers
foreach ($folders as $folder) {
    if (!file_exists($folder)) {
        mkdir($folder, 0777, true);
    }
}

echo "Structure de fichiers créée avec succès !";
?>
