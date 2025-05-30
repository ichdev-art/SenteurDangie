<?php include_once '../../templates/head.php'; ?>
<?php include_once '../../templates/sidebar.php'; ?>
<?php $fmt = new \NumberFormatter('fr_FR', \NumberFormatter::CURRENCY); ?>

<div class="container mt-5">
    <h2>Détail de la Commande #<?= htmlspecialchars($_GET['id']) ?></h2>
    <table class="table table-bordered text-center align-middle mt-4">
        <thead class="table-light">
            <tr>
                <th>Nom Produit</th>
                <th>Description</th>
                <th>Prix Unitaire</th>
                <th>Quantité</th>
                <th>Sous-Total</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $total = 0;
            for ($i = 0; $i < count($details); $i++) { 
                $sousTotal = $details[$i]['pro_prix'] * $details[$i]['comlig_quantité'];
                $total += $sousTotal;
            ?>
            <tr>
                <td><?= $details[$i]['pro_nom'] ?></td>
                <td><?= $details[$i]['pro_description'] ?></td>
                <td><?= $fmt->format($details[$i]['pro_prix']) ?></td>
                <td><?= $details[$i]['comlig_quantité'] ?></td>
                <td><?= $fmt->format($sousTotal) ?></td>
            </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr class="table-dark">
                <td colspan="4" class="text-end"><strong>Total :</strong></td>
                <td><strong><?= $fmt->format($total) ?></strong></td>
            </tr>
        </tfoot>
    </table>

    <a href="controller_commandeAdmin.php" class="btn btn-secondary">Retour</a>
</div>

<?php include_once '../../templates/script.php'; ?>
