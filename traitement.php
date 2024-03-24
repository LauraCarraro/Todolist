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
        $dsn = 'mysql:host=' . DATABASE_HOST . ";dbname=" . DATABASE_NAME;
        // Configuration pour obtenir les erreurs SQL
        $conn = new PDO($dsn, DATABASE_USER, DATABASE_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        
        $stmt = $conn->prepare("SELECT * FROM tdl_user WHERE E_mail = :email LIMIT 1");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Vérifiez si l'utilisateur existe
        if ($stmt->rowCount() === 1) {
            // Utilisateur trouvé, vérifiez le mot de passe
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            var_dump($row);
            if (password_verify($motdepasse, $row['Password'])) {
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
