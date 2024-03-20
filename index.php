<?php
session_start();
$isConnected = isset ($_SESSION["email"]);

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
<header>
  <?php
  include "components/navbar.php";
  ?>
</header>

<body>
  <?php if ($isConnected) { ?>
    <!--Création et affichage des tâches-->
    <section class="container pt-5" id="todolist">
      <br>
      <form id="creationTache" class="pb-4">
        <div class="form-group">
          <label for="nomTache">Nouvelle tâche</label>
          <input required="" class="form-control" type="text" id="nomTache" placeholder="Nom de la tâche" name="title"
            style="width: 100%">
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <input class="form-control" type="text" id="descriptionTache" placeholder="Décrire la tâche" name="description"
            style="width: 100%">
        </div>
        <div class="form-group d-flex">
          <div class="mr-2" style="flex: 1;">
            <label for="dateTache">Date</label>
            <input required="" type="date" id="dateTache" class="form-control" style="width: 60%;">
          </div>
          <div style="flex: 1;">
            <label for="priorite">Priorité</label>
            <select id="priorite" name="priorite" class="form-control" style="width: 60%;">
              <option value="basse">Basse</option>
              <option value="moyenne">Moyenne</option>
              <option value="haute">Haute</option>
              <option value="ultime">Ultime</option>
            </select>
          </div>
          <div style="flex: 1;">
            <label for="categorie">Catégorie</label>
            <select id="categorie" name="categorie" class="form-control" style="width: 60%;">
              <option value="personnel">Personnel</option>
              <option value="travail">Travail</option>
              <option value="famille">Famille</option>
              <option value="amis">Amis</option>
              <option value="autre">Autre</option>
            </select>
          </div>
        </div>
        <div class="form-group mt-2">
          <button id="btnAjouter" class="btn btn-dark">Ajouter</button>
        </div>
      </form>

      <div id="affichageTaches">
        <ul class="list-group" id="listeTaches">
          <!-- Les tâches seront ajoutées ici dynamiquement via JavaScript -->
        </ul>
      </div>
    <?php } else { ?>
      <section class="container pt-5">
        Connectez vous pour afficher les taches
      </section>
    <?php } ?>

    <script src="script.js" type="module"></script>
</body>

</html>