<?php

include_once '../../templates/head.php';
include_once '../../templates/sidebar.php';

?>

<!-- Page de création de produit -->

<div class="container my-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Ajouter un produit</h3>
            <a href="controller_produitAdmin.php" class="btn btn-light btn-sm">← Retour</a>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" novalidate>
                <div class="mb-3">
                    <label for="pro_nom" class="form-label">Nom du Produit</label>
                    <input type="text" name="nom" id="pro_nom" class="form-control" required>
                    <div class="text-danger small"><?= $error['nom'] ?? '' ?></div>
                </div>

                <div class="mb-3">
                    <label for="pro_description" class="form-label">Description</label>
                    <textarea name="description" id="pro_description" class="form-control" rows="4" required></textarea>
                    <div class="text-danger small"><?= $error['description'] ?? '' ?></div>
                </div>

                <div class="mb-3">
                    <label for="pro_prix" class="form-label">Prix (€)</label>
                    <input type="number" step="0.01" min="0" name="prix" id="pro_prix" class="form-control" required>
                    <div class="text-danger small"><?= $error['prix'] ?? '' ?></div>
                </div>

                <div class="mb-3">
                    <label for="pro_quantité" class="form-label">Quantité</label>
                    <input type="number" name="quantite" min="0" id="pro_quantité" class="form-control" required>
                    <div class="text-danger small"><?= $error['quantite'] ?? '' ?></div>
                </div>

                <div class="mb-4">
                    <label for="pro_img" class="form-label">Image du Produit</label>
                    <input type="file" name="img" id="pro_img" accept="image/*" class="form-control" required>
                    <div class="text-danger small"><?= $error['image'] ?? '' ?></div>
                </div>

                <button type="submit" class="btn btn-success w-100">Ajouter le Produit</button>
            </form>
        </div>
    </div>
</div>


<script>
    document.getElementById('pro_img').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const preview = document.createElement('img');
            preview.src = URL.createObjectURL(file);
            preview.className = "mt-3 img-thumbnail";
            preview.style.maxWidth = "200px";
            const container = document.querySelector('#pro_img').parentElement;
            const existing = container.querySelector('img');
            if (existing) existing.remove();
            container.appendChild(preview);
        }
    });

    const prixInput = document.getElementById('pro_prix');

    prixInput.addEventListener('keydown', function(e) {
        if (["e", "E", "+", "-"].includes(e.key)) {
            e.preventDefault();
        }
    });

    prixInput.addEventListener('input', function() {
        // Remplace tout ce qui n'est pas chiffre ou point
        this.value = this.value.replace(/[^\d.]/g, '');

        // Ne permet qu'un seul point
        if ((this.value.match(/\./g) || []).length > 1) {
            this.value = this.value.slice(0, -1);
        }
    });

    const quantiteInput = document.getElementById('pro_quantité');

    // Bloque les touches interdites : e, +, -, .
    quantiteInput.addEventListener('keydown', function(e) {
        if (["e", "E", "+", "-", "."].includes(e.key)) {
            e.preventDefault();
        }
    });

    // Nettoie le champ en entrée (empêche tout sauf chiffres)
    quantiteInput.addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, ''); // Supprime tout ce qui n’est pas un chiffre
    });
</script>


<?php
include_once '../../templates/script.php';
?>