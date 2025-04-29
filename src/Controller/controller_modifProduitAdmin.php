<?php 

session_start();

if (!isset($_SESSION['adm_id'])) {
    header('Location: controller_produitAdmin.php');
    exit;
}

$errors = [];

require_once '../../config.php';
require_once '../Model/model_produit.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

$fmt = new NumberFormatter('fr_FR', NumberFormatter::CURRENCY);
$produit = Produits::modifierProduit();

}
$produitId = Produits::avoirProduitParId();


include_once '../View/view_modifProduitAdmin.php';