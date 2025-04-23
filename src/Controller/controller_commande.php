<?php 

session_start();
require_once '../../config.php';
require_once '../Model/model_produit.php';

if (!isset($_SESSION['use_id'])) {
    header('Location: controller_connexion.php');
    exit;
}

include_once '../View/view_commande.php';