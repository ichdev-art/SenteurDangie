<?php

include_once '../../templates/head.php';
include_once '../../templates/navAdmin.php';

?>

<div class="admin-panel">
  <div class="panel-header">
    <h1>Gestion des Produits</h1>
    <a href="../Controller/controller_creationProduitAdmin.php" class="ajoute-button">Ajouter un produit</a>
  </div>
  <table class="produits-table">
    <thead>
      <tr>
        <th>Nom</th>
        <th>Description</th>
        <th>Prix</th>
        <th>Quantité</th>
        <th>Image</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($produit as $value) { ?>
        <tr>
          <td><?= $value['pro_nom'] ?></td>
          <td><?= $value['pro_description'] ?></td>
          <td><?= $fmt->formatCurrency($value["pro_prix"], "EUR") ?></td>
          <td><?= $value['pro_quantite'] ?></td>
          <td><?= $value['pro_img'] ?></td>
          <td>
            <a href="../Controller/controller_modifProduitAdmin.php?produit=<?= $value['pro_id']?>" class="modif">Modifier</a>
            <a href="../Controller/controller_suppressionC.php?produit=<?= $value['pro_id'] ?>" class="supprim">Supprimer</a>
          </td>
        </tr> 
        <?php } ?>
    </tbody>
  </table>
</div>


<?php
include_once '../../templates/script.php';
?>