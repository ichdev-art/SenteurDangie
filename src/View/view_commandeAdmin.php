<?php

include_once '../../templates/head.php';
include_once '../../templates/sidebar.php';

?>

<div class="container mt-5">
    <h2 class="mb-4">Liste des Commandes</h2>
    <table class="table table-bordered table-hover text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th>Commande ID</th>
                <th>Nom Client</th>
                <th>Email</th>
                <th>Date Commande</th>
                <th>Date Livraison</th>
                <th>Nombre Produits</th>
                <th>Total</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($commandT); $i++) { ?>
            <tr>
                <td><?= $commandT[$i]['com_id'] ?></td>
                <td><?= $commandT[$i]['use_prenom'] . ' ' . $commandT[$i]['use_nom'] ?></td>
                <td><?= $commandT[$i]['use_mail'] ?></td>
                <td><?= $commandT[$i]['com_dateCommande'] ?></td>
                <td><?= $commandT[$i]['com_dateLivraison'] ?></td>
                <td><?= $commandT[$i]['nb_produits'] ?></td>
                <td><?= $fmt->format($commandT[$i]['total']) ?></td>
                <td>
                    <a href="controller_detailCommandeAdmin.php?id=<?= $commandT[$i]['com_id'] ?>" class="btn btn-primary btn-sm">Voir</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>





<?php

include_once '../../templates/script.php';
?>