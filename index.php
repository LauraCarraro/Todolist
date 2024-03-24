<?php
require __DIR__ . '/config.php';
session_start();
$isConnected = isset ($_SESSION["email"]);

if ($isConnected) {
  $dsn = 'mysql:host=' . DATABASE_HOST . ";dbname=" . DATABASE_NAME;
  $conn = new PDO($dsn, DATABASE_USER, DATABASE_PASSWORD);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $priorites = $conn->query("SELECT * FROM Tdl_Priority")->fetchAll(PDO::FETCH_ASSOC);
  $categories = $conn->query("SELECT * FROM Tdl_Category")->fetchAll(PDO::FETCH_ASSOC);

  $stmt = $conn->prepare("SELECT Titre as nom, Description as description, Echéance as date, p.Nom as priorite FROM Tdl_Task t JOIN Tdl_Priority p on t.PriorityID=p.PriorityID WHERE UserID = :userID");
  $stmt->bindParam(':userID', $_SESSION["userID"]);
  $stmt->execute();
  $taches = $stmt->fetchAll(PDO::FETCH_ASSOC);

  if (!empty ($_POST)) {
    
    // Récupération des données postées
    $nomTache = !empty ($_POST['nomTache']) ? $_POST['nomTache'] : '';
    $descriptionTache = !empty ($_POST['descriptionTache']) ? $_POST['descriptionTache'] : '';
    $dateTache = !empty ($_POST['dateTache']) ? $_POST['dateTache'] : '';
    $prioriteTache = !empty ($_POST['prioriteTache']) ? $_POST['prioriteTache'] : '';
    // $categorieTache = !empty ($_POST['categorieTache']) ? $_POST['categorieTache'] : '';

    // Insertion de la nouvelle tâche
    $statement = $conn->prepare("INSERT INTO Tdl_Task(Titre, Description, Echéance, PriorityID, UserID) VALUES (:nomTache, :descriptionTache, :dateTache, :priorite, :userID)");
    $statement->execute(
      array(
        ':nomTache' => $nomTache,
        ':descriptionTache' => $descriptionTache,
        ':dateTache' => $dateTache,
        ':priorite' => (int) $prioriteTache,
        // ':categorie'=> (int) $categorieTache,
        ':userID' => $_SESSION["userID"]
      )
    );
    echo "Tâche ajoutée avec succès.";
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
<header>
  <?php
  include "components/navbar.php";
  ?>
</header>

<body>
  <?php if ($isConnected) { ?>
   
    <section class="container pt-5" id="todolist">
      <br>
      <form id="creationTache" action="#" method="POST" class="pb-4">
        <div class="form-group">
          <label for="nomTache">Nouvelle tâche</label>
          <input required="" class="form-control" type="text" id="nomTache" placeholder="Nom de la tâche" name="nomTache"
            style="width: 100%" value="<?= isset ($nomTache) ? $nomTache : '' ?>">
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <input class="form-control" type="text" id="descriptionTache" placeholder="Décrire la tâche"
            name="descriptionTache" style="width: 100%" value="<?= isset ($descriptionTache) ? $descriptionTache : '' ?>">
        </div>
        <div class="form-group d-flex">
          <div class="mr-2" style="flex: 1;">
            <label for="dateTache">Date</label>
            <input required="" type="date" id="dateTache" name="dateTache" class="form-control" style="width: 60%;"
              value="<?= isset ($dateTache) ? $dateTache : '' ?>">
          </div>
          <div style="flex: 1;">
            <label for="priorite">Priorité</label>
            <select name="prioriteTache">
              <?php foreach ($priorites as $priorite) { ?>
                <option value="<?= $priorite['PriorityID'] ?>" <?= isset ($prioriteTache) && $priorite['PriorityID'] === $prioriteTache ? 'selected' : '' ?>>
                  <?= $priorite['Nom'] ?>
                </option>
              <?php } ?>
            </select>
          </div>
          <div style="flex: 1;">
            <label for="categorie">Catégorie</label>
            <select name="categorieTache">
              <?php foreach ($categories as $categorie) { ?>
                <option value="<?= $categorie['CategoryID'] ?>" <?= isset ($categorieTache) && $categorie['CategoryID'] === $categorieTache ? 'selected' : '' ?>>
                  <?= $categorie['Nom'] ?>
                </option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="form-group mt-2">
          <button type="submit" id="btnAjouter" class="btn btn-dark">Ajouter</button>
        </div>
      </form>

      <div id="affichageTaches">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Nom</th>
              <th scope="col">Description</th>
              <th scope="col">Date</th>
              <th scope="col">Priorité</th>
              <th scope="col">Catégorie</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($taches as $tache) { ?>
              <tr>
                <th scope="row">
                  <?= $tache["nom"] ?>
                </th>
                <td>
                  <?= $tache["description"] ?>
                </td>
                <td>
                  <?= $tache["date"] ?>
                </td>
                <td>
                  <?= $tache["priorite"] ?>
                </td>
                <td>
                  </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    <?php } else { ?>
      <section class="container pt-5">
        Inscrivez-vous pour afficher les tâches
      </section>
    <?php } ?>

    <script src="script.js" type="module"></script>
</body>

</html>