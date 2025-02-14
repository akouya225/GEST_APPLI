<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les Applications</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form action="ajouterapp.php" method="POST">
    <h1>Les Applications</h1>
    <label for="nom">Nom</label>
    <input type="text" name="nom" placeholder="Nom" required><br><br>
    <label for="description">Description</label>
    <input type="text" name="description" placeholder="Description" required><br><br>
    <label for="statut">Statut</label>
    <input type="text" name="statut" placeholder="Statut" required><br><br>
    <label for="version">Version</label>
    <input type="text" name="version" placeholder="Version"><br><br>
    <label for="idarch">Architecture</label>
    <select name="idarch" id="idarch" required>
        <option value="1">Microservice</option>
        <option value="2">Monolitique</option>
    </select><br><br>
    <label for="idmopl">Mode de Déploiement</label>
    <select name="idmopl" id="idmopl" required>
        <option value="1">Container</option>
        <option value="2">Serveur</option>
        <option value="3">Instalable</option>
    </select><br><br>
    <label for="idnicou">Niveau de Couche</label>
    <select name="idnicou" id="idnicou" required>
        <option value="1">Back-end</option>
        <option value="2">Front-end</option>
        <option value="3">Full-stack</option>
    </select><br><br>
    <input type="submit" value="Envoyer">
</form>
<?php include 'header.php'; ?>

<div id="applications" class="section">
    <h2>Liste des Applications</h2>
    <button class="btn btn-add" onclick="location.href='ajouter_application.php'">Ajouter une application</button>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Statut</th>
                <th>Version</th>
                <th>Architecture</th>
                <th>Mode de Déploiement</th>
                <th>Niveau de Couche</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Connexion à la base de données
            try {
                $mysql = new PDO('mysql:host=localhost;dbname=gest_app', 'root', 'lucia');
                $mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erreur de connexion : " . $e->getMessage());
            }

            // Récupérer les données de la table `application`
            $sql = "SELECT id, nom, description, statut, version, idarch, idmopl, idnicou FROM application";
            $stmt = $mysql->query($sql);
            $applications = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($applications as $application) {
                echo "<tr>
                    <td>" . htmlspecialchars($application['id']) . "</td>
                    <td>" . htmlspecialchars($application['nom']) . "</td>
                    <td>" . htmlspecialchars($application['description']) . "</td>
                    <td>" . htmlspecialchars($application['statut']) . "</td>
                    <td>" . htmlspecialchars($application['version']) . "</td>
                    <td>" . htmlspecialchars($application['idarch']) . "</td>
                    <td>" . htmlspecialchars($application['idmopl']) . "</td>
                    <td>" . htmlspecialchars($application['idnicou']) . "</td>
                    <td class='d-flex'>
                        <a href='modificationapp.php?id=" . htmlspecialchars($application['id']) . "' class='btn'>Modifier</a>
                        <form action='ajouterapp.php' method='POST' style='display:inline;'>
                            <input type='hidden' name='id' value='" . htmlspecialchars($application['id']) . "'>
                            <input type='submit' name='delete' value='Supprimer' class='btn btn-danger'>
                        </form>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
