<form id="connexionForm" action="connexion.php" method="POST">
    <div>
        <div class="modal-content">
            <h2>Connexion</h2>
            <?php if (isset ($erreur)) { ?>
                <div class="invalid-feedback" style="display: block;">
                    <?= $erreur; ?>
                </div>
            <?php } ?>
            <div id="connexionForm" class="form-floating mb-3">
                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="floatingPassword"
                    placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div><br>
            <button id="btnConnecter" type="submit">Se connecter</button>
        </div>
    </div>
</form>