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


$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

// Récupération des stats
$countProduits = $pdo->query("SELECT COUNT(*) FROM 76_produits")->fetchColumn();
$countCommandes = $pdo->query("SELECT COUNT(*) FROM 76_commande")->fetchColumn();
$countUtilisateurs = $pdo->query("SELECT COUNT(*) FROM 76_users")->fetchColumn();

// Récupération des produits
$stmt = $pdo->query("SELECT * FROM 76_produits");
$produit = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Gestion de la notif suppression
$success = false;
if (!empty($_SESSION['delete_success'])) {
    $success = true;
    unset($_SESSION['delete_success']);
}


include_once '../View/view_produitAdmin.php';