<!DOCTYPE html>
<html lang="fr"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TodoList</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<header>
<?php
include "components/navbar.php";
?>
</header>
<body>

<?php
include "components/liste.php";
?>
<form action="../traitement.php" method="POST">
<div id="modalConnexion" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
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

<form action="../traitement.php" method="POST">
<div id="modalInscription" class="modal">
  <div class="modal-content">
    <span id="btn-close2"class="close">&times;</span>
    <h2>Inscription</h2>
    <div id="inscriptionForm" class="form-floating mb-3">
      <input type="text" class="form-control" id="prenom" placeholder="First name">
      <label for="prenom">Prénom</label>
    </div>
    <div id="inscriptionForm" class="form-floating mb-3">
      <input type="text" class="form-control" id="nom" placeholder="Last name">
      <label for="nom">Nom</label>
    </div>
    <div id="inscriptionForm" class="form-floating mb-3">
      <input type="email" class="form-control" id="email" placeholder="name@example.com">
      <label for="email">E-mail</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="motdepasse" placeholder="Password">
      <label for="motdepasse">Mot de passe</label>
    </div><br>
    <div class="form-floating">
      <input type="password" class="form-control" id="motdepasse2" placeholder="Password">
      <label for="motdepasse2">Rentrez le mot de passe une deuxième fois</label>
    </div><br>
    <button id="btnInscrire" type="submit">S'inscrire</button>
  </div>
</div>
</form>



<script src="script.js" type="module"></script>
</body>
</html>