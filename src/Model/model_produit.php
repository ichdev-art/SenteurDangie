<?php
class Produits
{
    public static function afficherProduit()
    {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'SELECT pro_nom,pro_img,pro_description,pro_prix,pro_quantité,pro_id from `76_produits`';

        $stmt = $pdo->prepare($sql);


        $stmt->execute();

        $bougieProduit = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $bougieProduit;
    }

public static function afficherUnProduit()
    {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'SELECT pro_nom,pro_img,pro_description,pro_prix,pro_quantité,avi_description,avi_date,use_nom,use_prenom from `76_produits` natural join `76_avis` natural join `76_users` where pro_id = :pro_id';

        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':pro_id', $_GET['produit'], PDO::PARAM_STR);

        $stmt->execute();

        $bougieProduitUn = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $bougieProduitUn;
    }
}


