<?php

session_start();
require_once '../../config.php';
require_once '../Model/model_produit.php';

if (!isset($_SESSION['user'])) {
    header('Location: controller_connexion.php');
    exit;
}

$fmt = new NumberFormatter('fr_FR', NumberFormatter::CURRENCY);
$command = Produits::afficheCommande();

include_once '../View/view_commande.php';
