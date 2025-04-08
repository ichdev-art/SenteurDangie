<?php

include_once '../../templates/head.php';
include_once '../../templates/nav.php';

?>


<form id="connexionC" method="POST" novalidate>
    <h1>Senteur D'angie</h1>
    <div class="label">
        <label for="mail">Email :</label><span><?= $error['email'] ?? '' ?></span>
        <input type="text" placeholder="Ex : Lebgdu76" name="email" id="mail" value="" required>

    </div>
    <div class="label">
        <label for="mdp">Mot de passe :</label><span><?= $error['mot_de_passe'] ?? '' ?></span>
        <input type="password" name="mot_de_passe" id="mdp" required>

    </div>
    <div class="label">
        <span><?= $error['connexion'] ?? '' ?></span>
        <input type="submit" value="Se connecter" id="valider">
        
    </div>
</form>
<div class="inscri">
    <p class="textnotcolor">Pas encore de compte ? <a href="./controller_inscription.php">Inscrivez-vous</a></p>
    <?php include_once '../../templates/footer.php' ?>
</div>