<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $libelle = isset($_POST['libelle']) ? htmlspecialchars($_POST['libelle']) : '';
    $description = isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '';
}

try {
    $mysql = new PDO('mysql:host=localhost;dbname=gest_app', 'root', 'lucia');
    $mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion !" . $e->getMessage());
}

$sql = "INSERT INTO Architecture(libelle, description) VALUES (:libelle, :description)";
$stmt = $mysql->prepare($sql);
$stmt->bindParam(':libelle', $libelle);
$stmt->bindParam(':description', $description);

if ($stmt->execute()) {
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Confirmation</title>
        <style>
            body {
                font-family: 'Arial', sans-serif;
                background: linear-gradient(to right, #ffafbd, #ffc3a0);
                color: #333;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }
            .container {
                background-color: rgba(255, 255, 255, 0.9);
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                border-radius: 12px;
                padding: 40px 50px;
                text-align: center;
                max-width: 500px;
                width: 100%;
                backdrop-filter: blur(10px);
            }
            h1 {
                font-size: 28px;
                color: #27ae60;
                margin-bottom: 20px;
            }
            p {
                font-size: 18px;
                color: #555;
                margin-bottom: 30px;
            }
            .btn {
                display: inline-block;
                padding: 15px 30px;
                font-size: 18px;
                cursor: pointer;
                text-align: center;
                text-decoration: none;
                color: #fff;
                background-color: #3498db;
                border: none;
                border-radius: 25px;
                transition: background-color 0.3s, transform 0.3s;
            }
            .btn:hover {
                background-color: #2980b9;
            }
            .btn:active {
                background-color: #2980b9;
                transform: translateY(2px);
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <h1>Enregistrement effectuée avec succès !</h1>
            <p>Merci d'avoir soumis vos informations. Vous pouvez revenir à la page précédente en cliquant sur le bouton ci-dessous.</p>
            <button class='btn' onclick='window.history.back();'>Retour</button>
        </div>
    </body>
    </html>";
} else {
    $errorinfo = $stmt->errorInfo();
    echo "Erreur lors de l'insertion : " . $errorinfo[2];
}
?>
