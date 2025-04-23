<?php
class Produits
{
    public static function afficherProduit()
    {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'SELECT pro_nom,pro_img,pro_description,pro_prix,pro_quantité,pro_id 
        from `76_produits`';

        $stmt = $pdo->prepare($sql);


        $stmt->execute();

        $bougieProduit = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $bougieProduit;
    }

    public static function afficherUnProduit()
    {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'SELECT pro_nom,pro_img,pro_description,pro_prix,pro_quantité,avi_description,avi_date,use_nom,use_prenom 
        from `76_produits` p
        left join `76_avis` a on p.pro_id = a.pro_id
        left join `76_users` u on a.use_id = u.use_id
        where p.pro_id = :pro_id';

        $date = new DateTimeImmutable();
        $date->format('d-m-Y');
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':pro_id', $_GET['produit'], PDO::PARAM_STR);

        $stmt->execute();

        $bougieProduitUn = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Formater les dates avec DateTimeImmutable
        foreach ($bougieProduitUn as &$produit) {
            if (isset($produit['avi_date'])) {
                $date = new DateTimeImmutable($produit['avi_date']);
                $produit['avi_date'] = $date->format('d F Y');
            }
        }

        return $bougieProduitUn;
    }

    public static function afficheCommande()
    {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'SELECT com_id,com_dateCommande,com_dateLivraison,com_quantitéCommande,pro_nom,pro_img,pro_prix 
        FROM 76_commande c 
        NATURAL JOIN 76_produits 
        WHERE pro_id = :pro_id';

        $stmt = $pdo->prepare($sql);

        $stmt->execute();

        $command = $stmt->fetch(PDO::FETCH_ASSOC);

        return $command;
    }
}
