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
            <img src="../../assets/img/<?= $value['pro_img'] ?>" class="card-img-top" alt="Bougie" />
          </a>
          <div class="card-body d-flex flex-column">
            <h5 class="card-title text-center"><?= $value['pro_nom'] ?></h5>
            <p class="card-text text-center textC"><?= $value['pro_description']?></p>
            <p class="text-center prix fw-bold"><?= $fmt->formatCurrency($value["pro_prix"], "EUR") ?></p>
            <a href="../Controller/controller_afficherProduits.php?produit=<?= $value['pro_id'] ?>" class="btn w-100 mt-auto">
              Ajouter au panier
            </a>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</section>

  <?php
  include_once '../../templates/footer.php';
  include_once '../../templates/script.php';
  ?>