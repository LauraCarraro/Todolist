<?php
require __DIR__ . '/config.php';
require_once __DIR__ . '/classes/Task.php';
require_once __DIR__ . '/classes/User.php';

if (
    !empty($_POST) &&
    isset($_POST['prenom']) &&
    isset($_POST['nom']) &&
    isset($_POST['email']) &&
    isset($_POST['motdepasse']) &&
    isset($_POST['motdepasse_confirmation']) && 
    $_POST['motdepasse'] === $_POST['motdepasse_confirmation'] 
) {
    $prenom = htmlspecialchars($_POST['prenom']);
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $motdepasse = htmlspecialchars($_POST['motdepasse']);
    
    $dsn = 'mysql:host=' . DATABASE_HOST . ";dbname=" . DATABASE_NAME;
    try {
        $connexion = new PDO($dsn, DATABASE_USER, DATABASE_PASSWORD);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $statement = $connexion->prepare("INSERT INTO tdl_user(Nom, Prénom, E_mail, Password) VALUES (:prenom, :nom, :email, :motdepasse)");
        $statement->execute(array(
            ':prenom' => $prenom,
            ':nom' => $nom,
            ':email' => $email,
            ':motdepasse' => password_hash($motdepasse, PASSWORD_DEFAULT)
        ));
        
        echo "Utilisateur ajouté avec succès.";
    } catch(PDOException $e) {
        echo "Erreur d'insertion dans la base de données : " . $e->getMessage();
    }
} else {
    echo "Les mots de passe ne correspondent pas.";
}
