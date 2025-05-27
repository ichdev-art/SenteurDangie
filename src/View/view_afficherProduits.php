<?php

include_once '../../templates/head.php';
include_once '../../templates/nav.php';

?>

<div class="affiche-produit">
  <div class="image-produit">
    <img src="/assets/img/<?= $produit[0]['pro_img'] ?>" alt="<?= $produit[0]['pro_nom'] ?>">
  </div>

  <div class="details-produit">
    <span class="badge-nouveaute">Nouveauté</span>
    <h2><?= $produit[0]['pro_nom'] ?></h2>

    <div class="note-produit">★★★★☆ (4.5/5)</div>

    <p class="prix"><?= $fmt->formatCurrency($produit[0]["pro_prix"], "EUR") ?></p>
    <p class="stock"><?= $produit[0]['pro_quantite'] ?> en stock</p>

    <div class="quantite-wrapper">
      <label for="quantite">Quantité :</label>
      <input type="number" name="quantite" id="quantite" value="1" min="1" max="<?= $produit[0]['pro_quantite'] ?>">
    </div>

    <form method="POST" class="ajout-panier-form">
      <input type="hidden" name="produit_id" value="<?= $produit[0]['pro_id'] ?>">
      <button type="submit" class="btn-panier">Ajouter au panier</button>
    </form>

    <ul class="arguments">
      <li>✓ Cire naturelle & végétale</li>
      <li>✓ Parfum longue durée</li>
      <li>✓ Fabriqué en France</li>
    </ul>

    <p class="description"><?= $produit[0]['pro_description'] ?></p>
  </div>
</div>

<?php if (!empty($produit[0]['avi_description'])) { ?>
  <h2 class="titlep text-center">Avis</h2>
  <div class="cardavis">
    <?php foreach ($produit as $value) { ?>
      <div class="avis">
        <div class="group">
          <h3><?= $value['use_nom'] . " " . $value['use_prenom'] ?></h3>
          <h3 class="date"><?= $value['avi_date'] ?></h3>
        </div>
        <p><?= $value['avi_description'] ?></p>
      </div>
    <?php } ?>
  </div>

<?php } ?>


<?php
include_once '../../templates/footer.php';
include_once '../../templates/script.php';
?>