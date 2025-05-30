<?php

include_once '../../templates/head.php';
include_once '../../templates/nav.php';

?>

<form id="connexionC" method="POST" novalidate>
  <h1 class="form-title">Senteur d'Angie</h1>

  <div class="form-group">
    <label for="mail">Email</label>
    <input type="email" id="mail" name="email" placeholder="exemple@domaine.com" required>
    <span class="error"><?= $error['email'] ?? '' ?></span>
  </div>

  <div class="form-group">
    <label for="mdp">Mot de passe</label>
    <input type="password" id="mdp" name="mot_de_passe" required>
    <span class="error"><?= $error['mot_de_passe'] ?? '' ?></span>
  </div>

  <div class="form-error"><?= $error['connexion'] ?? '' ?></div>

  <div class="form-group">
    <input type="submit" id="valider" value="Se connecter">
  </div>
</form>

<div class="inscri">
  <p class="textnotcolor text-center">
    Pas encore de compte ?
    <a href="./controller_inscription.php">Inscrivez-vous</a>
  </p>
</div>

<?php 

include_once '../../templates/footer.php';

?>
