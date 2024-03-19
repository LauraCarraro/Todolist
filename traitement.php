<?php
require __DIR__ . '/config.php';
require_once __DIR__ . '/classes/Task.php';
require_once __DIR__ . '/classes/User.php';

//Vérification des champs USER et envoi en base de données
if (
    !empty($_POST) &&
    isset($_POST['nom']) &&
    isset($_POST['prenom']) &&
    isset($_POST['email']) &&
    isset($_POST['motdepasse']) &&
    isset($_POST['motdepasse_confirmation']) && 
    $_POST['motdepasse'] === $_POST['motdepasse_confirmation'] 
) {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);
    $motdepasse = htmlspecialchars($_POST['motdepasse']);
    
    $dsn = 'mysql:host=' . DATABASE_HOST . ";dbname=" . DATABASE_NAME;
    try {
        $connexion = new PDO($dsn, DATABASE_USER, DATABASE_PASSWORD);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $statement = $connexion->prepare("INSERT INTO tdl_user(Nom, Prénom, E_mail, Password) VALUES (:nom, :prenom, :email, :motdepasse)");
        $statement->execute(array(
            ':nom' => $nom,
            ':prenom' => $prenom,
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
//
// // Vérifiez si les données du formulaire ont été soumises
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Récupérez les valeurs des champs email et mot de passe
//     $email = $_POST['email'];
//     $motdepasse = $_POST['motdepasse'];


// //Vérification utilisateur inscrit pour se connecter
//     try {
//         // Connexion à la base de données avec PDO
//         $conn = new PDO("mysql:host=localhost;dbname="DATABASE_NAME", "", "DATABASE_PASSWORD");

//         // Configuration pour obtenir les erreurs SQL
//         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//         // Préparez la requête SQL pour récupérer l'utilisateur en fonction de son e-mail
//         $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE email = :email");
//         $stmt->bindParam(':email', $email);
//         $stmt->execute();

//         // Vérifiez si l'utilisateur existe
//         if ($stmt->rowCount() > 0) {
//             // Utilisateur trouvé, vérifiez le mot de passe
//             $row = $stmt->fetch(PDO::FETCH_ASSOC);
//             if (password_verify($motdepasse, $row['motdepasse'])) {
//                 // Mot de passe correct, vous pouvez créer une session pour l'utilisateur et le rediriger
//                 session_start();
//                 $_SESSION['email'] = $email;
//                 // Rediriger l'utilisateur vers une page après la connexion
//                 header("Location: index.php");
//                 exit();
//             } else {
//                 // Mot de passe incorrect
//                 header("Location: index.php?erreur=mot_de_passe_incorrect");
//                 exit();
//             }
//         } else {
//             // Utilisateur non trouvé
//             header("Location: index.php?erreur=utilisateur_non_trouve");
//             exit();
//         }
//     } catch(PDOException $e) {
//         // Gestion des erreurs de connexion
//         echo "Erreur de connexion à la base de données : " . $e->getMessage();
//     }

//     // Fermez la connexion à la base de données
//     $conn = null;}
// }