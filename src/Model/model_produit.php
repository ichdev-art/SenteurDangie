<?php
class Produits
{
    public static function afficherProduit()
    {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'SELECT pro_nom,pro_img,pro_description,pro_prix,pro_quantité from `76_produits`';

        $stmt = $pdo->prepare($sql);

        $stmt->execute();

        $bougieProduit = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $bougieProduit;
    }
}
