<?php

include_once '../../templates/head.php';
include_once '../../templates/nav.php';

?>

<body>
    <form id="inscriptionF" action="" method="POST" novalidate>
      <h1>Senteur D'angie</h1>
      <div class="container">
        <label for="nom">Nom : </label><span><?= $error['nom'] ?? '' ?></span>
        <input type="text" name="nom" placeholder="Ex : Dubois" id="nom" value="" required />

      </div>
      <div class="container">
        <label for="prenom">Prénom :</label><span><?= $error['prenom'] ?? '' ?></span>
        <input
          type="text"
          name="prenom"
          id="prenom"
          value=""
          placeholder="Ex : Pierre"
          required
        />
      </div>

      <div class="container">
        <label for="mail">E-mail : </label><span><?= $error['email'] ?? '' ?></span>

        <input
          type="email"
          name="email"
          id="mail"
          value=""
          placeholder="Ex : Pierre.durand@gmail.com"
          required
        />
      </div>

      <div class="container">
        <label for="mdp">Mot de passe : </label><span><?= $error['mot_de_passe'] ?? '' ?></span>

        <input type="password" name="mot_de_passe" id="mdp" required />

      </div>

      <div class="container">
        <label for="c_mdp">Confirmation mot de passe : </label><span><?= $error['confirmation_mdp'] ?? '' ?></span>

        <input type="password" name="confirmation_mdp" id="c_mdp" required />
      </div>

      <div class="container">
        <label for="adresse"> Adresse : </label><span><?= $error['adresse'] ?? '' ?></span>

        <input type="text" name="adresse" placeholder="Ex : 3 rue du pont XI" id="adresse" value="" required />
      </div>

      <div class="container">
        <label for="cP">Code postal : </label><span><?= $error['codePostal'] ?? '' ?></span>

        <input type="number" name="codePostal" placeholder="Ex : 76620" id="cP" value="" required />
      </div>

      <div class="container">
        <label for="ville">Ville :</label><span><?= $error['ville'] ?? '' ?></span>

        <input type="text" name="ville" placeholder="Ex : Le Havre" id="ville" value="" required />
        <p></p>
      </div>

      <div class="container">
        <label for="cU">Conditions d'utilisation : </label><span><?= $error['condition'] ?? '' ?></span>

        <input type="checkbox" name="condition" id="cU" required />
      </div>

      <input type="submit" value="Valider" id="valider" />
      <p>
        Déjà un compte ?
        <a href="../Controller/controller_connexion.php">Connectez-vous</a>
      </p>
    </form>

    <?php include_once '../../templates/footer.php' ?>
</body>