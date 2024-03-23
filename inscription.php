<?php
require __DIR__ . "/config.php";
session_start();

if (!empty ($_POST)) {
    $erreurs = [];
    $nom = !empty ($_POST['nom']) ? htmlspecialchars($_POST['nom']) : '';
    $prenom = !empty ($_POST['prenom']) ? htmlspecialchars($_POST['prenom']) : '';
    $email = !empty ($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $motdepasse = !empty ($_POST['motdepasse']) ? htmlspecialchars($_POST['motdepasse']) : '';
    $motdepasse_confirmation = !empty ($_POST['motdepasse_confirmation']) ? htmlspecialchars($_POST['motdepasse_confirmation']) : '';

    if ($nom === '') {
        $erreurs['nom'] = 'Le nom est requis.';
    } elseif (strlen($nom) < 3 || strlen($nom) > 50) {
        $erreurs['nom'] = 'Le nom doit faire entre 3 et 50 caractères.';
    }

    if ($prenom !== '' && (strlen($prenom) < 3 || strlen($prenom) > 50)) {
        $erreurs['prenom'] = 'Le prénom doit faire entre 3 et 50 caractères.';
    }

    if ($nom === '') {
        $erreurs['email'] = "L'email est requis.";
    } elseif (strlen($email) < 3 || strlen($email) > 80) {
        $erreurs['email'] = "L'email doit faire entre 3 et 80 caractères.";
    }

    if ($motdepasse === '') {
        $erreurs['motdepasse'] = 'Le mot de passe est requis.';
    } elseif (strlen($motdepasse) < 7) {
        $erreurs['motdepasse'] = "Le mot de passe doit faire plus de 7 caractères.";
    }

    if ($motdepasse !== $motdepasse_confirmation) {
        $erreurs['motdepasse_confirmation'] = 'Les mots de passes ne sont pas identiques.';
    }
    // Le formulaire est valide, ajout en BDD
    if (empty ($erreurs)) {
        try {
            $dsn = 'mysql:host=' . DATABASE_HOST . ";port=3306;dbname=" . DATABASE_NAME;
            $connexion = new PDO($dsn, DATABASE_USER, DATABASE_PASSWORD);
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $statement = $connexion->prepare("INSERT INTO Tdl_User(Nom, Prénom, Email, Password) VALUES (:nom, :prenom, :email, :motdepasse)");
            $statement->execute(
                array(
                    ':nom' => $nom,
                    ':prenom' => $prenom,
                    ':email' => $email,
                    ':motdepasse' => password_hash($motdepasse, PASSWORD_DEFAULT)
                )
            );
            echo "Utilisateur ajouté avec succès.";

            $stmt = $connexion->prepare("SELECT * FROM Tdl_User WHERE Email = :email LIMIT 1");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            $_SESSION['email'] = $email;
            $_SESSION['userID'] = $user["UserID"];
            // Rediriger l'utilisateur vers une page après la connexion
            header("Location: index.php");
            exit();
        } catch (PDOException $e) {
            var_dump($e->getMessage());
            die();
            echo "Erreur d'insertion dans la base de données : " . $e->getMessage();
        }
    }
}

$page = "html/inscription.vue.php";
include "html/template.php";