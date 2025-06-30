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
      btn.addEventListener('click', (e) => {
        const i = e.currentTarget.dataset.index;
        panier.splice(i, 1);
        sauvegarderPanier();
        afficherPanier();
      });
    });

    // Gestion quantités
    document.querySelectorAll('.changer-quantite').forEach(input => {
      input.addEventListener('change', (e) => {
        const i = e.currentTarget.dataset.index;
        const qte = parseInt(e.currentTarget.value);
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
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        const id = e.currentTarget.dataset.id;
        const nom = e.currentTarget.dataset.nom;
        const prix = parseFloat(e.currentTarget.dataset.prix);
        const img = e.currentTarget.dataset.img;

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