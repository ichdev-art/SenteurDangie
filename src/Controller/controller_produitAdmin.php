<?php 

session_start();

if (!isset($_SESSION['adm_id'])) {
    header('Location: controller_produitAdmin.php');
    exit;
}


require_once '../../config.php';
require_once '../Model/model_produit.php';


$fmt = new NumberFormatter('fr_FR', NumberFormatter::CURRENCY);
$produit = Produits::afficherProduit();



include_once '../View/view_produitAdmin.php';