<?php

include_once '../../templates/head.php';
include_once '../../templates/nav.php';

?>


<div class="commande-card">
  <?php foreach ($command as $commande) { ?>

    <div class="commande-header">
      <h3 class="command">Commande n°<?= $commande['com_id'] ?></h3>
      <p>Passée le <?= $commande['com_dateCommande'] ?></p>
    </div>

    <div class="commande-produits">

      <?php foreach ($commande['produits'] as $produit) { ?>

        <div class="produit">
          <img src="/assets/img/<?= $produit['pro_img'] ?>" alt="<?= $produit['pro_nom'] ?>">
          <div class="infos">
            <h3 class="dateLivraison">Date de livraison prévue : <?= $commande['com_dateLivraison'] ?></h3>
            <p class="nom"><?= $produit['pro_nom'] ?></p>
            <p>Quantité : <?= $produit['comlig_quantité'] ?></p>
            <p>Prix : <?= $fmt->formatCurrency($produit['pro_prix'], "EUR") ?></p>
          </div>
        </div>

      <?php } ?>

    </div>

    <div class="commande-footer">
      <p>Total : <?= $fmt->formatCurrency($commande['total'], "EUR") ?></p>
    </div>
    
  <?php } ?>

</div>


<?php
include_once '../../templates/footer.php';
include_once '../../templates/script.php';
?>