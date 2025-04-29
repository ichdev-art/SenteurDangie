<?php 

include_once '../../templates/head.php';
include_once '../../templates/navAdmin.php';

?>


<div class="modifier-produit">
    <div class="modifier-header">
        <h1>Modifier un produit</h1>
    </div>
    <form method="POST" enctype="multipart/form-data" novalidate>
        <label for="pro_nom">Nom du Produit :</label>
        <input type="text" name="nom" id="pro_nom" value="<?= $produitId['pro_nom'] ?? "" ?>" required>

        <label for="pro_description">Description :</label>
        <textarea name="description" id="pro_description" required><?= $produitId['pro_description'] ?? "" ?></textarea>

        <label for="pro_prix">Prix :</label>
        <input type="number" name="prix" id="pro_prix" value="<?= $produitId['pro_prix'] ?? "" ?>" required>

        <label for="pro_quantité">Quantité :</label>
        <input type="number" name="quantite" id="pro_quantité" value="<?= $produitId['pro_quantite'] ?? "" ?>" required>

        <button type="submit">Modifier le Produit</button>
    </form>
    <div class="modif-footer">
        <a href="../Controller/controller_produitAdmin.php" class="retour-button">Retour</a>
    </div>
</div>



<?php 
    include_once '../../templates/script.php';
    ?>