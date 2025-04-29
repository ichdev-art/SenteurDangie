<?php 
require_once '../../config.php';

session_start();

if (isset($_SESSION['adm_id'])) {
    header('Location: controller_produitAdmin.php');
    exit;
}

$error = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['pseudo'])) {
        if (empty($_POST['pseudo'])) {
            $error['pseudo'] = 'Pseudo obligatoire';
        }
    }
    if (isset($_POST['mot_de_passe'])) {
        if (empty($_POST['mot_de_passe'])) {
            $error['mot_de_passe'] = 'Mot de passe obligatoire';
        }
    }

    if (!empty($_POST['pseudo']) && !empty($_POST['mot_de_passe'])) {
        // On se connecte a la base de donnée via pdo = creation instance
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
        // Options avance sur notre instance
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        

        $sql = 'SELECT adm_id,adm_pseudo,adm_mdp from 76_admin where adm_pseudo = :pseudo';

        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);

        $stmt->execute();

        $stmt->rowCount() == 0 ? $found = false : $found = true;

        // on stock le resultat de la requete dans un tableau associatif
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($found == false) {
            $error['connexion'] = 'Pseudo ou Mot de passe incorrect';
        } else {
            if (password_verify($_POST['mot_de_passe'], $user['adm_mdp'])) {
                $_SESSION = $user;
                header('Location: controller_produitAdmin.php');
                exit;
            } else {
                $error['connexion'] = 'Pseudo ou Mot de passe incorrect';
            }
        }

        $pdo = '';

    }
} 

include_once '../View/view_connexionAdmin.php';