<?php 

session_start();

if (!isset($_SESSION['adm_id'])) {
    header('Location: controller_creationProduitAdmin.php');
    exit;
}

require_once '../../config.php';
require_once '../Model/model_produit.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['nom'])) {
        if (empty($_POST['nom'])) {
            $error['nom'] = 'Nom obligatoire';
        }
    }
    if (isset($_POST['description'])) {
        if (empty($_POST['description'])) {
            $error['description'] = 'Description obligatoire';
        }
    }
    if (isset($_POST['prix'])) {
        if (empty($_POST['prix'])) {
            $error['prix'] = 'Prix obligatoire';
        } elseif (!is_numeric($_POST['prix'])) {
            $error['prix'] = 'Prix non valide';
        }
    }
    if (isset($_POST['quantite'])) {
        if (empty($_POST['quantite'])) {
            $error['quantite'] = 'Quantité obligatoire';
        } elseif (!is_numeric($_POST['quantite'])) {
            $error['quantite'] = 'Quantité non valide';
        }
    }
    
    $resultat = Produits::ajouterProduit();
    if ($resultat !== true) {
        $error['image'] = $resultat;    
    }
  
        if (empty($error)) {
            // Appel de la méthode pour ajouter le produit
            $produit = Produits::ajouterProduit();
            header("Location: ../Controller/controller_produitAdmin.php");  // Redirection vers une page de succès
            exit;
        }
    }









include_once '../View/view_creationProduitAdmin.php';