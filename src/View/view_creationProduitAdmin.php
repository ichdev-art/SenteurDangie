<?php 

include_once '../../templates/head.php';
include_once '../../templates/navAdmin.php';

?>

<!-- Page de création de produit -->

<div class="ajouter-produit">
    <div class="ajouter-header">
        <h1>Ajouter un produit</h1>
    </div>
    <form method="POST" enctype="multipart/form-data" novalidate>
        <label for="pro_nom">Nom du Produit : <span class="error"><?= $error['nom'] ?? '' ?></span></label>
        <input type="text" name="nom" id="pro_nom" required>
        
        <label for="pro_description">Description : <span class="error"><?= $error['description'] ?? '' ?></span></label>
        <textarea name="description" id="pro_description" required></textarea>

        <label for="pro_prix">Prix : <span class="error"><?= $error['prix'] ?? '' ?></span></label>
        <input type="number" name="prix" id="pro_prix" required>

        <label for="pro_quantité">Quantité : <span class="error"><?= $error['quantite'] ?? '' ?></span></label>
        <input type="number" name="quantite" id="pro_quantité" required>

        <label for="pro_img">Image Produit : <span class="error"><?= $error['image'] ?? '' ?></span></label>
        <input type="file" name="img" id="pro_img" accept="image/*" required>

        <button type="submit">Ajouter le Produit</button>
    </form>
    <div class="ajout-footer">
        <a href="../Controller/controller_produitAdmin.php" class="retour-button">Retour</a>
    </div>
</div>


<?php 
    include_once '../../templates/script.php';
    ?>