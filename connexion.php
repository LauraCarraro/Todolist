<?php
require __DIR__ . '/config.php';
require_once __DIR__ . '/classes/Task.php';
require_once __DIR__ . '/classes/User.php';

session_start();
if (isset ($_SESSION["email"])) {
    header("Location: index.php");
    exit();
}

// Vérifiez si les données du formulaire ont été soumises
if (!empty ($_POST)) {
    // Récupérez les valeurs des champs email et mot de passe
    $email = htmlspecialchars($_POST['email']);
    $motdepasse = htmlspecialchars($_POST['motdepasse']);

    //Vérification utilisateur inscrit pour se connecter
    try {
        // Connexion à la base de données avec PDO
        $conn = new PDO("mysql:host=localhost;dbname=" . DATABASE_NAME, "", "DATABASE_PASSWORD");

        // Configuration pour obtenir les erreurs SQL
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparez la requête SQL pour récupérer l'utilisateur en fonction de son e-mail
        $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE email = :email LIMIT 1");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Vérifiez si l'utilisateur existe
        if ($stmt->rowCount() === 1) {
            // Utilisateur trouvé, vérifiez le mot de passe
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($motdepasse, $row['motdepasse'])) {
                // Mot de passe correct, vous pouvez créer une session pour l'utilisateur et le rediriger
                $_SESSION['email'] = $email;
                // Rediriger l'utilisateur vers une page après la connexion
                header("Location: index.php");
                exit();
            } else {
                // Mot de passe incorrect
                $erreur = "Le mot de passe est incorrect";
            }
        } else {
            // Utilisateur non trouvé
            $erreur = "Utilisateur inconnu";
        }
    } catch (PDOException $e) {
        // Gestion des erreurs de connexion
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
        exit();
    }

    // Fermez la connexion à la base de données
    $conn = null;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TodoList</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<body>
    <header>
        <?php
        include "components/navbar.php";
        ?>
    </header>
    <form id="connexionForm" action="connexion.php" method="POST">
        <div>
            <div class="modal-content">
                <?php
                if (isset ($erreur)) {
                    echo $erreur;
                }
                ?>
                <h2>Connexion</h2>
                <div id="connexionForm" class="form-floating mb-3">
                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div><br>
                <button id="btnConnecter" type="submit">Se connecter</button>
            </div>
        </div>
    </form>
</body>