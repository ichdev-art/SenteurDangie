<?php 

include_once '../../templates/head.php';
include_once '../../templates/sidebar.php';

?>


<div class="modifier-produit">
    <div class="modifier-header">
        <h1>Modifier un produit</h1>
    </div>
    <form method="POST" enctype="multipart/form-data" novalidate>
        <label for="pro_nom">Nom du Produit :
            <span class="error"><?= $error['nom'] ?? '' ?></span>
        </label>
        <input type="text" name="nom" id="pro_nom" value="<?= $produitId['pro_nom'] ?? "" ?>" required>

        <label for="pro_description">Description :
            <span class="error"><?= $error['description'] ?? '' ?></span>
        </label>
        <textarea name="description" id="pro_description" required><?= $produitId['pro_description'] ?? "" ?></textarea>

        <label for="pro_prix">Prix :
            <span class="error"><?= $error['prix'] ?? '' ?></span>
        </label>
        <input type="number" name="prix" id="pro_prix" min="0" step="0.01" value="<?= $produitId['pro_prix'] ?? "" ?>" required>

        <label for="pro_quantité">Quantité :
            <span class="error"><?= $error['quantite'] ?? '' ?></span>
        </label>
        <input type="number" name="quantite" id="pro_quantité" min="0" value="<?= $produitId['pro_quantite'] ?? "" ?>" required>

        <button type="submit">Modifier le Produit</button>
    </form>
    <div class="modif-footer">
        <a href="../Controller/controller_produitAdmin.php" class="retour-button">Retour</a>
    </div>
</div>

<!-- JavaScript pour bloquer e, -, +, etc. dans les inputs number -->
<script>
  document.querySelectorAll('input[type="number"]').forEach(input => {
    input.addEventListener('keydown', function(e) {
      if (["e", "E", "+", "-"].includes(e.key)) {
        e.preventDefault();
      }
    });
  });
</script>




<?php 
    include_once '../../templates/script.php';
    ?>