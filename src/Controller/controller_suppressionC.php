<?php

session_start();

require_once '../../config.php';
require_once '../Model/model_produit.php';

$produit = Produits::deleteProduit();

$_SESSION['delete_success'] = true;
header('Location: controller_produitAdmin.php');
exit;

if (!isset($_SESSION['adm_id'])) {
    header('Location: controller_produitAdmin.php');
    exit;
}
