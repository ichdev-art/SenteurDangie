<?php 
require_once '../../config.php';
session_start();

if (isset($_SESSION['adm_id'])) {
    header('Location: controller_produitAdmin.php');
    exit;
}



$error = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pseudo = trim($_POST['pseudo'] ?? '');
    $mot_de_passe = $_POST['mot_de_passe'] ?? '';

    if (empty($pseudo)) {
        $error['pseudo'] = 'Pseudo obligatoire';
    }

    if (empty($mot_de_passe)) {
        $error['mot_de_passe'] = 'Mot de passe obligatoire';
    }

    if (empty($error)) {
        try {
            $pdo = new PDO(
                'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8',
                DB_USER,
                DB_PASS,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );

            $stmt = $pdo->prepare('SELECT adm_id, adm_pseudo, adm_mdp FROM 76_admin WHERE adm_pseudo = :pseudo');
            $stmt->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user || !password_verify($mot_de_passe, $user['adm_mdp'])) {
                $error['connexion'] = 'Pseudo ou mot de passe incorrect';
            }

            if (empty($error)) {
                $_SESSION['adm_id'] = $user['adm_id'];
                $_SESSION['adm_pseudo'] = $user['adm_pseudo'];
                header('Location: controller_produitAdmin.php');
                exit;
            }

        } catch (PDOException $e) {
            $error['connexion'] = 'Erreur de connexion à la base de données.';
        }
    }
}

include_once '../View/view_connexionAdmin.php';
