<?php

include_once '../../templates/head.php';
include_once '../../templates/nav.php';

?>

<section class="container my-5">
  <h3 class="text-center titleC mb-4">
    Découvrez notre sélection de bougies artisanales et végétales.
  </h3>

  <div class="row g-4">
    <?php foreach ($produit as $value) { ?>
      <div class="col-md-4">
        <div class="card shadow-sm h-100 mtg-card-custom">
          <a href="../Controller/controller_afficherProduits.php?produit=<?= $value['pro_id'] ?>">
            <img src="../../assets/img/<?= $value['pro_img'] ?>" class="card-img-top" alt="<?= $value['pro_nom'] ?>" />
          </a>
          <div class="card-body d-flex flex-column">
            <h5 class="card-title text-center"><?= $value['pro_nom'] ?></h5>
            <p class="card-text text-center textC"><?= $value['pro_description'] ?></p>
            <p class="text-center prix fw-bold"><?= $fmt->formatCurrency($value["pro_prix"], "EUR") ?></p>
            <?php if (isset($_SESSION['user'])) { ?>
              <button class="btn ajouterPanier"
                data-id="<?= $value['pro_id'] ?>"
                data-nom="<?= $value['pro_nom'] ?>"
                data-prix="<?= $value['pro_prix'] ?>"
                data-img="<?= $value['pro_img'] ?>">
                Ajouter au panier
              </button>
            <?php } else { ?>
              <a href="controller_connexion.php" class="btn btn-secondary">
                Connectez-vous pour commander
              </a>
            <?php } ?>

          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</section>
<!-- Modal panier sur le côtés  -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="modalPanier" aria-labelledby="modalPanierLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="modalPanierLabel">Votre panier</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body" id="contenuPanier">
    <!-- JS génère les produits ici -->
  </div>
  <div class="offcanvas-footer p-3 border-top">
    <div class="d-flex justify-content-between mb-3">
      <strong>Total :</strong> <span id="totalPanier">0.00 €</span>
    </div>
    <a href="/src/Controller/controller_commande.php" class="btn btn-primary w-100">Commander</a>
  </div>

  


  <?php
  include_once '../../templates/scriptpanier.php';
  include_once '../../templates/footer.php';
  include_once '../../templates/script.php';
  ?>

  