<?php

include_once '../../templates/head.php';
include_once '../../templates/nav.php';

?>

<section class="container my-5">
  <h3 class="text-center titleC mb-4">
    Découvrez notre sélection de bougies artisanales et végétales.
  </h3>

  <div class="row g-4">
    <?php foreach ($produit as $value) { ?>
      <div class="col-md-4">
        <div class="card shadow-sm h-100 mtg-card-custom">
          <a href="../Controller/controller_afficherProduits.php?produit=<?= $value['pro_id'] ?>">
            <img src="../../assets/img/<?= $value['pro_img'] ?>" class="card-img-top" alt="Bougie" />
          </a>
          <div class="card-body d-flex flex-column">
            <h5 class="card-title text-center"><?= $value['pro_nom'] ?></h5>
            <p class="card-text text-center textC"><?= $value['pro_description'] ?></p>
            <p class="text-center prix fw-bold"><?= $fmt->formatCurrency($value["pro_prix"], "EUR") ?></p>
            <?php if (isset($_SESSION['user'])) { ?>
              <button class="btn ajouterPanier"
                data-id="<?= $value['pro_id'] ?>"
                data-nom="<?= $value['pro_nom'] ?>"
                data-prix="<?= $value['pro_prix'] ?>"
                data-img="<?= $value['pro_img'] ?>">
                Ajouter au panier
              </button>
            <?php } else { ?>
              <a href="controller_connexion.php" class="btn btn-secondary">
                Connectez-vous pour commander
              </a>
            <?php } ?>

          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</section>
<!-- Modal panier latéral -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="modalPanier" aria-labelledby="modalPanierLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="modalPanierLabel">Votre panier</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body" id="contenuPanier">
    <!-- JS génère les produits ici -->
  </div>
  <div class="offcanvas-footer p-3 border-top">
    <div class="d-flex justify-content-between mb-3">
      <strong>Total :</strong> <span id="totalPanier">0.00 €</span>
    </div>
    <a href="/src/Controller/controller_commande.php" class="btn btn-primary w-100">Commander</a>
  </div>

  
<script>
    let panier = JSON.parse(localStorage.getItem('panier')) || [];

    function sauvegarderPanier() {
      localStorage.setItem('panier', JSON.stringify(panier));
    }

    function afficherPanier() {
      const conteneur = document.getElementById('contenuPanier');
      const totalElem = document.getElementById('totalPanier');
      const compteur = document.getElementById('compteurPanier');
      conteneur.innerHTML = '';
      let total = 0;
      let compteurTotal = 0;

      if (panier.length === 0) {
        conteneur.innerHTML = '<p>Votre panier est vide.</p>';
        totalElem.textContent = '0.00 €';
        compteur.textContent = '0';
        return;
      }

      panier.forEach((produit, index) => {
        const sousTotal = produit.prix * produit.quantite;
        total += sousTotal;
        compteurTotal += produit.quantite;

        conteneur.innerHTML += `
      <div class="d-flex align-items-center mb-3">
        <img src="../../assets/img/${produit.img}" alt="${produit.nom}" width="60" class="me-3" />
        <div class="flex-grow-1">
          <strong>${produit.nom}</strong><br/>
          <small>${produit.prix.toFixed(2)} €</small><br/>
          <input type="number" min="1" value="${produit.quantite}" data-index="${index}" class="form-control form-control-sm w-50 mt-1 changer-quantite">
        </div>
        <button class="btn btn-sm btn-outline-danger ms-2 supprimer-produit" data-index="${index}">&times;</button>
      </div>
    `;
      });

      totalElem.textContent = `${total.toFixed(2)} €`;
      compteur.textContent = compteurTotal;

      // Gestion suppression
      document.querySelectorAll('.supprimer-produit').forEach(btn => {
        btn.addEventListener('click', function() {
          const i = this.dataset.index;
          panier.splice(i, 1);
          sauvegarderPanier();
          afficherPanier();
        });
      });

      // Gestion quantités
      document.querySelectorAll('.changer-quantite').forEach(input => {
        input.addEventListener('change', function() {
          const i = this.dataset.index;
          const qte = parseInt(this.value);
          if (qte > 0) {
            panier[i].quantite = qte;
            sauvegarderPanier();
            afficherPanier();
          }
        });
      });
    }

    // Ajout produit
    document.querySelectorAll('.ajouterPanier').forEach(btn => {
      btn.addEventListener('click', function(e) {
        e.preventDefault();
        const id = this.dataset.id;
        const nom = this.dataset.nom;
        const prix = parseFloat(this.dataset.prix);
        const img = this.dataset.img;

        const index = panier.findIndex(p => p.id === id);
        if (index !== -1) {
          panier[index].quantite += 1;
        } else {
          panier.push({
            id,
            nom,
            prix,
            img,
            quantite: 1
          });
        }

        sauvegarderPanier();
        afficherPanier();

        const modal = new bootstrap.Offcanvas(document.getElementById('modalPanier'));
        modal.show();
      });
    });

    // Ouvrir le panier via bouton navbar
    document.getElementById('btnOuvrirPanier').addEventListener('click', () => {
      afficherPanier();
      const modal = new bootstrap.Offcanvas(document.getElementById('modalPanier'));
      modal.show();
    });

    // Initialisation au chargement
    document.addEventListener('DOMContentLoaded', afficherPanier);
    
  </script>


  <?php
  include_once '../../templates/footer.php';
  include_once '../../templates/script.php';
  ?>

  