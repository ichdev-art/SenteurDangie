<?php

include_once '../../templates/head.php';
include_once '../../templates/navAdmin.php';

?>

<section class="admin-panell">
  <div class="panel-header">
    <h1>Suppression de Produit</h1>
  </div>
  <div class="confirmation-message">
    <p>Le produit a été supprimé avec succès.</p>
    <a href="../Controller/controller_produitAdmin.php" class="retour-button">Retour à la liste des produits</a>
  </div>


<?php
include_once '../../templates/script.php';
?>