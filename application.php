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
                <p class="mb-0 font-weight-medium me-3 buy-now-text"></p>
                <a href="https://www.bootstrapdash.com/product/skydash-admin-template" target="_blank" class="btn me-2 buy-now-btn border-0">Buy Now</a>
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






             
          <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Applications</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
            background-color: #f4f4f9;
        }

        header, footer {
            background-color: #333;
            color: white;
            padding: 1px;
            text-align: center;
            width: 100%;
        }

        .container {
            display: flex;
            flex: 1;
            flex-direction: column;
        }

        nav {
            width: 20%;
            background-color: #555;
            color: white;
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        nav a {
            color: white;
            display: block;
            padding: 10px 0;
            text-decoration: none;
        }

        nav a:hover {
            background-color: #666;
        }

        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 20px;
        }

        .content {
            width: 100%;
        }

        .table-container {
            width: 100%;
            margin: auto;
        }

        .table-list {
            width: 100%;
            font-size: 16px;
            border-collapse: collapse;
        }

        .table-list th, .table-list td {
            padding: 8px 12px;
            border: 1px solid #ddd;
        }

        .table-list th {
            font-weight: bold;
        }

        .table-list tr:nth-child(even) {
            background-color: transparent;
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            width: 20%;
            margin: auto;
        }

        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #28a745;
            color: white;
            text-align: center;
        }

        button.btn-back {
            background-color: #007bff;
        }

        /* Bouton personnalisé */
        .btn-unique {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 1px;
        }

        .btn-unique:hover {
            background-color: #45a049;
        }

        .right {
            float: right;
            
        }
        .table .thead-light th {
    color: #fff;
    background-color: #268fd4;
}
    </style>
</head>
<body>
    <header>
        <h2>Liste des Applications</h2>
    </header>
    <div class="container mt-4">
        <button type="submit" class="right btn-secondary" onclick="location.href='application_manager.php'">Ajouter une application</button>
        <div class="table-container">
            
                <table class="table-list table-striped table-bordered table-sm text-center">
                    <thead class="thead-light">
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
                                <td class='d-flex justify-content-around'>
                                    <a href='modificationapp.php?id=" . htmlspecialchars($application['id']) . "' class='btn btn-primary btn-sm' title='Modifier les informations'><i class='fas fa-edit'></i></a>
                                        <a href='detail_application.php?id=" . htmlspecialchars($application['id']) . "' class='btn btn-pink btn-sm' title='voir les informations'><i class='fas fa-eye'></i></a>
                                    </td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <?php include 'js.php'; ?>
</body>
</html>
