<?php 

include_once '../../templates/head.php';
include_once '../../templates/nav.php';

?>

<h3 class="titleC">
      Découvrez notre sélection de bougies Artisanale et végétales.
    </h3>
    <div class="card">
      <?php foreach ($produit as $value) { ?>
      <div class="card-corp">
         <a href="../Controller/controller_afficherProduits.php?produit=<?= $value['pro_id']?>">
          <img src="../../assets/img/<?=$value['pro_img']?>" alt="Bougie" />
        </a>
        <h2><?= $value['pro_nom'] ?></h2>
        <p class="textC"><?= $value['pro_description']?></p>
        <a href="../Controller/controller_afficherProduits.php?produit=<?= $value['pro_id'] ?>" class="En savoir plus">En savoir plus</a>
        <p class="prix"><?= $fmt->formatCurrency($value["pro_prix"], "EUR") ?></p>

      </div>
          <?php } ?>
    </div>

    <?php 
    include_once '../../templates/footer.php';
    include_once '../../templates/script.php';
    ?>