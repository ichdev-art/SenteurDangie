<?php

session_start();

if (!isset($_SESSION['adm_id'])) {
    header('Location: controller_creationProduitAdmin.php');
    exit;
}

require_once '../../config.php';
require_once '../Model/model_produit.php';

$fmt = new NumberFormatter('fr_FR', NumberFormatter::CURRENCY);
$commandT = Produits::afficherToutecommande();


include_once '../View/view_commandeAdmin.php';