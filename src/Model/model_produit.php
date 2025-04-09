<?php
class Produits
{
    public static function afficherProduit($pro_id)
    {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT pro_nom,pro_description,pro_prix,pro_quantité FROM 76_produits WHERE pro_id = :pro_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':pro_id', $pro_id, PDO::PARAM_INT);
        $stmt->execute();
    }
}