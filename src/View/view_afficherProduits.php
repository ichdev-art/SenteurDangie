<?php 

include_once '../../templates/head.php';
include_once '../../templates/nav.php';

?>

<div class="affiche">
      <img src="/assets/img/<?= $produit[0]['pro_img']?>" alt="" />
      <div class="cadre">
        <h2><?= $produit[0]['pro_nom']?></h2>
        <p><?= $fmt->formatCurrency($produit[0]["pro_prix"], "EUR") ?></p>
        <p><?= $produit[0]['pro_quantité']?> en Stock</p>
        <p>
        <?= $produit[0]['pro_description']?> Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis officia in fugit repudiandae. Voluptate dolorem atque pariatur doloribus velit omnis assumenda impedit exercitationem dolor. Porro id harum, libero labore voluptates inventore consectetur accusantium, molestias impedit ducimus amet laborum, minus exercitationem cumque eveniet assumenda adipisci. Facere dolorem fugit minima officiis dolores odit quas saepe dolor vitae qui, cumque quae nisi sapiente!
        </p>
      </div>
    </div>
<h2 class="titlep">Avis</h2>
    <div class="cardavis">
      <?php foreach ($produit as  $value) { ?>
      <div class="avis">
        <div class="group">
          <h3><?= $value['use_nom'] . " " . $value['use_prenom'] ?></h3>
          <h3 class="date"><?= $value['avi_date']?></h3>
        </div>
        <p>
        <?= $value['avi_description']?>
        </p>
      </div>
    <?php } ?>
    </div>
      









<?php 
    include_once '../../templates/footer.php';
    include_once '../../templates/script.php';
    ?>