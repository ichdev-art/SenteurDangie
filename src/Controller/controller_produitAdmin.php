<?php 

session_start();
require_once '../../config.php';
require_once '../Model/model_produit.php';


$fmt = new NumberFormatter('fr_FR', NumberFormatter::CURRENCY);
$produit = Produits::afficherProduit();



include_once '../View/view_produitAdmin.php';