<?php

include_once '../../templates/head.php';
include_once '../../templates/nav.php';

?>

<body>
  <form id="inscriptionF" method="POST" novalidate>
  <h1 class="form-title">Senteur D'angie</h1>

  <div class="form-group">
    <label for="nom">Nom</label>
    <input type="text" id="nom" name="nom" placeholder="Ex : Dubois" value="<?= $_POST['nom'] ?? '' ?>" required>
    <span class="error"><?= $error['nom'] ?? '' ?></span>
  </div>

  <div class="form-group">
    <label for="prenom">Prénom</label>
    <input type="text" id="prenom" name="prenom" placeholder="Ex : Pierre" value="<?= $_POST['prenom'] ?? '' ?>" required>
    <span class="error"><?= $error['prenom'] ?? '' ?></span>
  </div>

  <div class="form-group">
    <label for="mail">Email</label>
    <input type="email" id="mail" name="email" placeholder="Ex : pierre.durand@gmail.com" value="<?= $_POST['email'] ?? '' ?>" required>
    <span class="error"><?= $error['email'] ?? '' ?></span>
  </div>

  <div class="form-group">
    <label for="mdp">Mot de passe</label>
    <input type="password" id="mdp" name="mot_de_passe" required>
    <span class="error"><?= $error['mot_de_passe'] ?? '' ?></span>
  </div>

  <div class="form-group">
    <label for="c_mdp">Confirmation du mot de passe</label>
    <input type="password" id="c_mdp" name="confirmation_mdp" required>
    <span class="error"><?= $error['confirmation_mdp'] ?? '' ?></span>
  </div>

  <div class="form-group">
    <label for="adresse">Adresse</label>
    <input type="text" id="adresse" name="adresse" placeholder="Ex : 3 rue du Pont XI" value="<?= $_POST['adresse'] ?? '' ?>" required>
    <span class="error"><?= $error['adresse'] ?? '' ?></span>
  </div>

  <div class="form-group">
    <label for="cP">Code postal</label>
    <input type="number" id="cP" name="codePostal" placeholder="Ex : 76620" value="<?= $_POST['codePostal'] ?? '' ?>" required>
    <span class="error"><?= $error['codePostal'] ?? '' ?></span>
  </div>

  <div class="form-group">
    <label for="ville">Ville</label>
    <input type="text" id="ville" name="ville" placeholder="Ex : Le Havre" value="<?= $_POST['ville'] ?? '' ?>" required>
    <span class="error"><?= $error['ville'] ?? '' ?></span>
  </div>

  <div class="form-group checkbox">
    <input type="checkbox" id="cU" name="condition" required>
    <label for="cU">J'accepte les conditions d'utilisation</label>
    <span class="error"><?= $error['condition'] ?? '' ?></span>
  </div>

  <div class="form-group">
    <input type="submit" value="Valider" id="valider">
  </div>

  <p class="textnotcolor">
    Déjà un compte ? <a href="../Controller/controller_connexion.php">Connectez-vous</a>
  </p>
</form>

  <?php 
  include_once '../../templates/footer.php';
  include_once '../../templates/script.php';
  ?>
</body>