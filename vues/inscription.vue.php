<form id="inscriptionForm" action="#" method="POST">
    <div id="modalInscription">
        <div class="modal-content">
            <h2>Inscription</h2>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="nom" placeholder="Nom" name="nom"
                    value="<?= isset ($nom) ? $nom : '' ?>">
                <label for="nom">Nom</label>
                <?php if (isset ($erreurs['nom'])) { ?>
                    <div class="invalid-feedback" style="display: block;">
                        <?= $erreurs['nom'] ?>
                    </div>
                <?php } ?>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="prenom" placeholder="Prénom" name="prenom"
                    value="<?= isset ($prenom) ? $prenom : '' ?>">
                <label for="prenom">Prénom</label>
                <?php if (isset ($erreurs['prenom'])) { ?>
                    <div class="invalid-feedback" style="display: block;">
                        <?= $erreurs['prenom'] ?>
                    </div>
                <?php } ?>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email"
                    value="<?= isset ($email) ? $email : '' ?>">
                <label for="email">E-mail</label>
                <?php if (isset ($erreurs['email'])) { ?>
                    <div class="invalid-feedback" style="display: block;">
                        <?= $erreurs['email'] ?>
                    </div>
                <?php } ?>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="motdepasse" placeholder="Password" name="motdepasse"
                    value="<?= isset ($motdepasse) ? $motdepasse : '' ?>">
                <label for=" motdepasse">Mot de passe</label>
                <?php if (isset ($erreurs['motdepasse'])) { ?>
                    <div class="invalid-feedback" style="display: block;">
                        <?= $erreurs['motdepasse'] ?>
                    </div>
                <?php } ?>
            </div><br>
            <div class="form-floating">
                <input type="password" class="form-control" id="motdepasse2" placeholder="Password"
                    name="motdepasse_confirmation"
                    value="<?= isset ($motdepasse_confirmation) ? $motdepasse_confirmation : '' ?>">
                <label for="motdepasse2">Rentrez le mot de passe une deuxième fois</label>
                <?php if (isset ($erreurs['motdepasse_confirmation'])) { ?>
                    <div class="invalid-feedback" style="display: block;">
                        <?= $erreurs['motdepasse_confirmation'] ?>
                    </div>
                <?php } ?>
            </div><br>
            <button id="btnInscrire" type="submit">S'inscrire</button>
        </div>
    </div>
</form>