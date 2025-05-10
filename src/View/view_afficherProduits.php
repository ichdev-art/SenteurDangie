<?php 

include_once '../../templates/head.php';
include_once '../../templates/nav.php';

?>

<div class="affiche">
      <img src="/assets/img/<?= $produit[0]['pro_img']?>" alt="" />
      <div class="cadre">
        <h2><?= $produit[0]['pro_nom']?></h2>
        <p><?= $fmt->formatCurrency($produit[0]["pro_prix"], "EUR") ?></p>
        <p><?= $produit[0]['pro_quantite']?> en Stock</p>
        <p>
        <?= $produit[0]['pro_description']?>
        </p>
      </div>
    </div>
    <?php if (!empty($produit[0]['avi_description'])) { ?>
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
    <?php } ?>
    

<?php 
    include_once '../../templates/footer.php';
    include_once '../../templates/script.php';
    ?>