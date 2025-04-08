<?php 
require_once '../../config.php';

$regex_name = "/^[a-zA-Zï]+$/";
$regex_password = "/^[a-zA-Z0-9]{8,30}+$/";
$regex_adresse = "/^([1-9][0-9]*(?:-[1-9][0-9]*)?)\s*(bis|ter|qua)?\s+([\p{L}\-]+)\s+([\p{L}0-9\s\'\-]+)$/";
$regex_postal = "/([0-9]{5})/";
$error = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['nom'])) {
        if (empty($_POST['nom'])) {
            $error['nom'] = 'Nom obligatoire';
        } elseif (!preg_match($regex_name, $_POST['nom'])) {
            $error['nom'] = 'Caractère non autorisés';
        }
    }
    if (isset($_POST['prenom'])) {
        if (empty($_POST['prenom'])) {
            $error['prenom'] = 'Prénom obligatoire';
        } else if (!preg_match($regex_name, $_POST['prenom'])) {
            $error['prenom'] = 'Caractère non autorisés';
        }
    }
    $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT use_mail from `76_users` where use_mail = :use_mail';

    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':use_mail', $_POST['email'], PDO::PARAM_STR);

    $stmt->execute();

    $stmt->rowCount() == 0 ? $found = false : $found = true;

    $pdo = '';

    if (isset($_POST['email'])) {
        if (empty($_POST['email'])) {
            $error['email'] = 'Email obligatoire';
        } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $error['email'] = 'Email non valide';
        } else if ($found == true) {
            $error['email'] = 'Email déjà utilisé';
        }
    }
    if (isset($_POST['mot_de_passe'])) {
        if (empty($_POST['mot_de_passe'])) {
            $error['mot_de_passe'] = 'Mot de passe obligatoire';
        } else if (!preg_match($regex_password, $_POST['mot_de_passe'])) {
            if (strlen($_POST['mot_de_passe']) < 8) {
                $error['mot_de_passe'] = 'Trop petit';
            }
            if (strlen($_POST['mot_de_passe']) > 30) {
                $error['mot_de_passe'] = 'Trop grand';
            }
        }
    }
    if (isset($_POST['confirmation_mdp'])) {
        if (empty($_POST['confirmation_mdp'])) {
            $error['confirmation_mdp'] = 'Mot de passe obligatoire';
        } else if (!preg_match($regex_password, $_POST['confirmation_mdp'])) {
            $error['confirmation_mdp'] = 'le mot de passe est valide';
        } else if (($_POST['confirmation_mdp'] != $_POST['mot_de_passe'])) {
            $error['confirmation_mdp'] = 'les mots de passe ne corresponde pas';
        }
    }

    if (isset($_POST['adresse'])) {
        if (empty($_POST['adresse'])) {
            $error['adresse'] = 'Adresse obligatoire';
        } elseif (!preg_match($regex_adresse, $_POST['adresse'])) {
            $error['adresse'] = 'Adresse non autorisés';
        }
    }

    if (isset($_POST['codePostal'])) {
        if (empty($_POST['codePostal'])) {
            $error['codePostal'] = 'Code postal obligatoire';
        }else if (!preg_match($regex_postal, $_POST['codePostal'])) {
            $error['codePostal'] = 'Code postal a 5 chiffre';
        }
    }
    if (isset($_POST['ville'])) {
        if (empty($_POST['ville'])) {
            $error['ville'] = 'Ville obligatoire';
        }

        if (!isset($_POST['condition'])) {
            $error['condition'] = 'Condition obligatoire';
        }
    }
    if (empty($error)) {

        // On se connecte a la base de donnée via pdo = creation instance
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

        // Options avance sur notre instance
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // On stock notre requête avec des marqueurs nominatif
        $sql = 'INSERT INTO 76_users (use_nom,use_prenom,use_mail,use_mdp,use_adresse,use_codePostal,use_ville)
        VALUES
        (:use_nom,:use_prenom,:use_mail,:use_mdp,:use_adresse,:use_codePostal,:use_ville)';

        // On prépare la requête avant de l'exécuter
        $stmt = $pdo->prepare($sql);

        // function permettant de nettoyer les inputs
        function safeInput($string)
        {
            $input = trim($string);
            $input = htmlspecialchars($input);
            return $input;
        }

        $stmt->bindValue(":use_codePostal", safeInput($_POST["codePostal"]), PDO::PARAM_STR);
        $stmt->bindValue(":use_nom", safeInput($_POST["nom"]), PDO::PARAM_STR);
        $stmt->bindValue(":use_prenom", safeInput($_POST["prenom"]), PDO::PARAM_STR);
        $stmt->bindValue(":use_adresse", safeInput($_POST["adresse"]), PDO::PARAM_STR);
        $stmt->bindValue(":use_ville", safeInput($_POST["ville"]), PDO::PARAM_STR);
        $stmt->bindValue(":use_mail", safeInput($_POST["email"]), PDO::PARAM_STR);
        $stmt->bindValue(":use_mdp", password_hash($_POST["mot_de_passe"], PASSWORD_DEFAULT), PDO::PARAM_STR);

        // On test si la requête execute
        if ($stmt->execute()) {
            header('Location: controller_confirmation.php');
            exit;
        }

        // on supprime l'instance pdo
        $pdo = '';
    }
};





include_once '../View/view_inscription.php';
?>