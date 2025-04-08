
<?php
// API JSON : pas besoin d'inclure les parties HTML
require_once '../paramettre/bd.php'; // Connexion à la base

// En-tête pour indiquer un retour JSON
header('Content-Type: application/json');

$table= "architecture";
// Affichage des erreurs (utile en dev)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Récupération des données
$sql = "SELECT * FROM {$table}";
$stmt = $mysql->query($sql);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Retour JSON
echo json_encode($data);


?>
