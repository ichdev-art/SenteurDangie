<?php 

session_start();
require_once '../../config.php';
require_once '../Model/model_produit.php';

$produit = Produits::AfficherProduit();





include_once '../View/view_afficherToutproduits.php';
?>