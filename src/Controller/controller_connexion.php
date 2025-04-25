<?php 
require_once '../../config.php';

session_start();

if (isset($_SESSION['use_id'])) {
    header('Location: controller_afficherToutproduits.php');
    exit;
}

$error = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email'])) {
        if (empty($_POST['email'])) {
            $error['email'] = 'Email ou pseudo obligatoire';
        }
    }
    if (isset($_POST['mot_de_passe'])) {
        if (empty($_POST['mot_de_passe'])) {
            $error['mot_de_passe'] = 'Mot de passe obligatoire';
        }
    }

    if (!empty($_POST['email']) && !empty($_POST['mot_de_passe'])) {
        // On se connecte a la base de donnée via pdo = creation instance
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
        // Options avance sur notre instance
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        

        $sql = 'SELECT use_id,use_nom,use_prenom,use_mail,use_mdp from 76_users where use_mail = :mail';

        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':mail', $_POST['email'], PDO::PARAM_STR);

        $stmt->execute();

        $stmt->rowCount() == 0 ? $found = false : $found = true;

        // on stock le resultat de la requete dans un tableau associatif
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($found == false) {
            $error['connexion'] = 'Email ou Mot de passe incorrect';
        } else {
            if (password_verify($_POST['mot_de_passe'], $user['use_mdp'])) {
                $_SESSION = $user;
                header('Location: controller_afficherToutproduits.php');
                exit;
            } else {
                $error['connexion'] = 'Email ou Mot de passe incorrect';
            }
        }

        $pdo = '';

    }
} 

include_once '../View/view_connexion.php';