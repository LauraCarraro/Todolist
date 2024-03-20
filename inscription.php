<?php
 require __DIR__ ."/config.php";
 
if (
    !empty($_POST) &&
    isset($_POST['nom']) &&
    isset($_POST['prenom']) &&
    isset($_POST['email']) &&
    isset($_POST['motdepasse']) &&
    isset($_POST['motdepasse_confirmation'])
) {
    $erreurs = [];
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);
    $motdepasse = htmlspecialchars($_POST['motdepasse']);
    $motdepasse_confirmation = htmlspecialchars($_POST['motdepasse_confirmation']);

    if (strlen($nom) < 3 || strlen($nom) > 50) {
        $erreurs['nom'] = 'Le nom est requis et doit faire entre 3 et 50 caractères.';
    }

    if (strlen($prenom) < 3 || strlen($prenom) > 50) {
        $erreurs['prenom'] = 'Le prénom doit faire entre 3 et 50 caractères.';
    }

    if (strlen($email) < 3 || strlen($email) > 80) {
        $erreurs['email'] = "L'email est requis et doit faire entre 3 et 80 caractères.";
    }

    if (strlen($motdepasse) < 7) {
        $erreurs['motdepasse'] = "Le mot de passe est requis et doit faire plus de 7 caractères.";
    }

    if ($motdepasse !== $motdepasse_confirmation) {
        $erreurs['motdepasse_confirmation'] = 'Les mots de passes ne sont pas identiques.';
    }

    // Le formulaire est valide, ajout en BDD
    if (empty($erreurs)) {
        $dsn = 'mysql:host=' . DATABASE_HOST . ";dbname=" . DATABASE_NAME;
        try {
            $connexion = new PDO($dsn, DATABASE_USER, DATABASE_PASSWORD);
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $statement = $connexion->prepare("INSERT INTO tdl_user(Nom, Prénom, E_mail, Password) VALUES (:nom, :prenom, :email, :motdepasse)");
            $statement->execute(
                array(
                    ':nom' => $nom,
                    ':prenom' => $prenom,
                    ':email' => $email,
                    ':motdepasse' => password_hash($motdepasse, PASSWORD_DEFAULT)
                )
            );
            echo "Utilisateur ajouté avec succès.";

            $_SESSION['email'] = $email;
            // Rediriger l'utilisateur vers une page après la connexion
            header("Location: index.php");
            exit();
        } catch (PDOException $e) {
            echo "Erreur d'insertion dans la base de données : " . $e->getMessage();
        }
    }
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
        <?php include "components/navbar.php"; ?>
    </header>
    <form id="inscriptionForm" action="#" method="POST">
        <div id="modalInscription">
            <div class="modal-content">
                <span id="btn-close2" class="close">&times;</span>
                <h2>Inscription</h2>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nom" placeholder="Nom" name="nom"
                        value="<?= isset($nom) ? $nom : '' ?>">
                    <label for="nom">Nom</label>
                    <?php if (isset($erreurs['nom'])) { ?>
                        <div class="invalid-feedback" style="display: block;">
                            <?= $erreurs['nom'] ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="prenom" placeholder="Prénom" name="prenom"
                        value="<?= isset($prenom) ? $prenom : '' ?>">
                    <label for="prenom">Prénom</label>
                    <?php if (isset($erreurs['prenom'])) { ?>
                        <div class="invalid-feedback" style="display: block;">
                            <?= $erreurs['prenom'] ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email"
                        value="<?= isset($email) ? $email : '' ?>">
                    <label for="email">E-mail</label>
                    <?php if (isset($erreurs['email'])) { ?>
                        <div class="invalid-feedback" style="display: block;">
                            <?= $erreurs['email'] ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="motdepasse" placeholder="Password"
                        name="motdepasse">
                    <label for="motdepasse">Mot de passe</label>
                    <?php if (isset($erreurs['motdepasse'])) { ?>
                        <div class="invalid-feedback" style="display: block;">
                            <?= $erreurs['motdepasse'] ?>
                        </div>
                    <?php } ?>
                </div><br>
                <div class="form-floating">
                    <input type="password" class="form-control" id="motdepasse2" placeholder="Password"
                        name="motdepasse_confirmation"
                        value="<?= isset($motdepasse_confirmation) ? $motdepasse_confirmation : '' ?>">
                    <label for="motdepasse2">Rentrez le mot de passe une deuxième fois</label>
                    <?php if (isset($erreurs['motdepasse_confirmation'])) { ?>
                        <div class="invalid-feedback" style="display: block;">
                            <?= $erreurs['motdepasse_confirmation'] ?>
                        </div>
                    <?php } ?>
                </div><br>
                <button id="btnInscrire" type="submit">S'inscrire</button>
            </div>
        </div>
    </form>
</body>