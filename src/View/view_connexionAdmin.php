<?php

include_once '../../templates/head.php';
include_once '../../templates/sidebar.php';

?>

<div class="connexion-page">
    <div class="connexion-box">
        <h2>Connexion Admin</h2>
        <form method="POST" action="" novalidate>

            <span><?= $error['pseudo'] ?? '' ?></span>
            <input name="pseudo" type="text" placeholder="Pseudo" required>

            <span><?= $error['mot_de_passe'] ?? '' ?></span>
            <input name="mot_de_passe" type="password" placeholder="Mot de passe" required>

            <span><?= $error['connexion'] ?? '' ?></span>
            <button type="submit" name="login_admin" value="Se connecter">Se connecter</button>

        </form>
    </div>
</div>



<?php
include_once '../../templates/script.php';
?>