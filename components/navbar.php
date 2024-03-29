<nav class="navbar navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">ToDoList</a>
    <div class="d-flex justify-content-between">
      <?php ?>
      <?php if (isset ($isConnected) && $isConnected === false) { ?>
        <a href="inscription.php">
          <button type="button" class="btn btn-secondary me-2">Inscription</button>
        </a>
        <a href="connexion.php">
          <button type="button" class="btn btn-secondary">Connexion</button>
        </a>
      <?php } ?>
      <?php if (isset ($isConnected) && $isConnected === true) { ?>
        <a href="deconnexion.php">
          <button type="button" class="btn btn-secondary me-2">Déconnexion</button>
        </a>
        <?php } ?>
    </div>
    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
      aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Dark offcanvas</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
        </ul>
        <form class="d-flex mt-3" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </div>
</nav>