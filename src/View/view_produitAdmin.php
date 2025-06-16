<?php

include_once '../../templates/head.php';
include_once '../../templates/sidebar.php';

?>

<main class="flex-fill p-4">
  
  <!-- Alerte pour supprimer avec succes ! -->
  <?php
  if ($success) {
    echo '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          Produit supprimé avec succès.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
  }
  ?>

  <!-- Stats des produit/users/commande -->
  <div class="row mb-4">
    <div class="col-md-4">
      <div class="card text-bg-dark">
        <div class="card-body">
          <h5 class="card-title">Produits</h5>
          <p class="card-text fs-3 text-white"><?= $countProduits ?></p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card text-bg-dark">
        <div class="card-body">
          <h5 class="card-title">Commandes</h5>
          <p class="card-text fs-3 text-white"><?= $countCommandes ?></p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card text-bg-dark">
        <div class="card-body">
          <h5 class="card-title">Utilisateurs</h5>
          <p class="card-text fs-3 text-white"><?= $countUtilisateurs ?></p>
        </div>
      </div>
    </div>
  </div>

  <!-- Gestionnaire de produit -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Liste des Produits</h2>
    <a href="controller_creationProduitAdmin.php" class="btn btn-primary">Ajouter un produit</a>
  </div>

  <table class="table table-bordered table-hover">
    <thead class="table-dark">
      <tr>
        <th>ID Produit</th>
        <th>Nom</th>
        <th>Description</th>
        <th>Prix</th>
        <th>Quantité</th>
        <th>Image</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($produit as $value) { ?>
        <tr>
          <td><?= htmlspecialchars($value['pro_id']) ?></td>
          <td><?= $value['pro_nom'] ?></td>
          <td><?= $value['pro_description'] ?></td>
          <td><?= $fmt->formatCurrency($value["pro_prix"], "EUR") ?></td>
          <td><?= $value['pro_quantite'] ?></td>
          <td>
            <img class="img_admin" src="../../assets/img/<?= $value['pro_img'] ?>" style="width:50px;" alt="<?= $value['pro_nom'] ?>">
          </td>
          <td>
            <div class="d-flex gap-2">
              <a href="controller_modifProduitAdmin.php?produit=<?= $value['pro_id'] ?>" class="btn btn-sm btn-warning">Modifier</a>
              <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDelete<?= $value['pro_id'] ?>">
                Supprimer
              </button>
            </div>
            <div class="modal fade" id="confirmDelete<?= $value['pro_id'] ?>" tabindex="-1" aria-labelledby="modalLabel<?= $value['pro_id'] ?>" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="modalLabel<?= $value['pro_id'] ?>">Confirmer la suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                  </div>
                  <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer le produit <strong><?= $value['pro_nom'] ?></strong> ?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <a href="controller_suppressionC.php?produit=<?= $value['pro_id'] ?>" class="btn btn-danger">Supprimer</a>
                  </div>
                </div>
              </div>
            </div>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</main>
</div>

<?php
include_once '../../templates/script.php';
?>