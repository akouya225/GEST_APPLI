<?php
// Connexion à la base de données
try {
    $mysql = new PDO('mysql:host=localhost;dbname=gest_app', 'root', 'lucia');
    $mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Récupérer les applications sélectionnées
$sql = "SELECT nom FROM selected_applications";
$stmt = $mysql->query($sql);
$selected_apps = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applications Sélectionnées</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-4">Applications Sélectionnées</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-sm text-center">
                <thead class="thead-lighter">
                    <tr>
                        <th class="py-2">Nom</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($selected_apps as $app) {
                        echo "<tr>
                            <td>" . htmlspecialchars($app['nom']) . "</td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <button type="button" class="btn btn-secondary" onclick="location.href=''">Retour</button>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
