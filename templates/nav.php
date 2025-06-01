<nav class="navbar navbar-expand-lg custom-navbar shadow-sm">
  <div class="container-fluid">
    <h1 class="navbar-brand fw-bold" href="#">Senteur d'Angie</h1>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="/src/Controller/controller_afficherToutproduits.php">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/src/Controller/controller_commande.php">Commandes</a>
        </li>
        <li class="nav-item">
          <button class="btn position-relative" id="btnOuvrirPanier">
            🛒
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="compteurPanier">0</span>
          </button>
        </li>
      </ul>


      <ul class="navbar-nav ms-auto">
        <?php if (isset($_SESSION['user'])) { ?>
          <li class="nav-item">
            <a class="nav-link" href="../Controller/controller_deconnexion.php">
              <i class="fa-solid fa-right-from-bracket"></i> Déconnexion
            </a>
          </li>
        <?php } else { ?>
          <li class="nav-item">
            <a class="nav-link" href="../Controller/controller_connexion.php">
              <i class="fa-solid fa-user"></i> Connexion
            </a>
          </li>
        <?php } ?>
      </ul>

    </div>
  </div>
</nav>