<?php
session_start();

if (!isset($_SESSION['adm_id'])) {
    header('Location: controller_creationProduitAdmin.php');
    exit;
}

require_once '../../config.php';
require_once '../Model/model_produit.php';

if (!isset($_GET['id'])) {
    header('Location: controller_commandeAdmin.php');
    exit;
}

$commandeId = intval($_GET['id']);
$details = Produits::afficherDetailCommande($commandeId);

include_once '../View/view_detailCommandeAdmin.php';
