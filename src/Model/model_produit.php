<?php
class Produits
{
    /**
     * 
     * 
     * 
     * 
     */
    public static function afficherProduit()
    {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'SELECT pro_nom,pro_img,pro_description,pro_prix,pro_quantite,pro_id 
        from `76_produits`';

        $stmt = $pdo->prepare($sql);


        $stmt->execute();

        $bougieProduit = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $bougieProduit;
    }

    /**
     * 
     * 
     * 
     * 
     */
    public static function afficherUnProduit()
    {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'SELECT pro_nom,pro_img,pro_description,pro_prix,pro_quantite,avi_description,avi_date,use_nom,use_prenom 
        from `76_produits` p
        left join `76_avis` a on p.pro_id = a.pro_id
        left join `76_users` u on a.use_id = u.use_id
        where p.pro_id = :pro_id';

        $date = new DateTimeImmutable();
        $date->format('d-m-Y');
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':pro_id', $_GET['produit'], PDO::PARAM_INT);

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

    /**
     * 
     * 
     * 
     * 
     */
    public static function afficheCommande()
    {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'SELECT 
                    u.use_id,
                    u.use_nom,
                    u.use_prenom,
                    u.use_mail,
                    c.com_id,
                    c.com_dateCommande,
                    c.com_dateLivraison,
                    p.pro_nom,
                    p.pro_description,
                    p.pro_prix,
                    p.pro_img,
                    cl.comlig_quantite
                FROM 76_commande c
                JOIN 76_users u ON c.use_id = u.use_id
                JOIN 76_commande_ligne cl ON c.com_id = cl.com_id
                JOIN 76_produits p ON cl.pro_id = p.pro_id
                where u.use_id = :use_id';

        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':use_id', $_SESSION['use_id'], PDO::PARAM_INT);

        $stmt->execute();

        $command = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($command as &$value) {
            if (isset($value['com_dateCommande'])) {
                $date = new DateTimeImmutable($value['com_dateCommande']);
                $dateL = new DateTimeImmutable($value['com_dateLivraison']);
                $value['com_dateLivraison'] = $dateL->format('d F Y');
                $value['com_dateCommande'] = $date->format('d F Y');
            }
        }
        unset($value);

        // Créer un tableau pour stocker les commandes et les produits associés

        $commandes = [];

        // Parcourir les résultats et regrouper les produits par commande et calculer le total de chaque commande

        foreach ($command as $row) {

            // Vérifier si la commande existe déjà dans le tableau sinon, l'ajouter

            $com_id = $row['com_id'];
            if (!isset($commandes[$com_id])) {

                // Créer une nouvelle entrée pour la commande avec les informations de la commande et un tableau vide pour les produits et le total initialisé à 0

                $commandes[$com_id] = [
                    'com_id' => $com_id,
                    'com_dateCommande' => $row['com_dateCommande'],
                    'com_dateLivraison' => $row['com_dateLivraison'],
                    'produits' => [],
                    'total' => 0
                ];
            }

            // Ajouter le produit à la commande et calculer le total de la commande

            $commandes[$com_id]['produits'][] = [
                'pro_nom' => $row['pro_nom'],
                'pro_description' => $row['pro_description'],
                'pro_prix' => $row['pro_prix'],
                'pro_img' => $row['pro_img'],
                'comlig_quantite' => $row['comlig_quantite']
            ];

            // Calculer le total de la commande en multipliant le prix du produit par la quantite

            $commandes[$com_id]['total'] += $row['pro_prix'] * $row['comlig_quantite'];
        }

        // Réinitialiser les clés du tableau pour qu'elles soient continues
        return $commandes;
    }

    /**
     * 
     * 
     * 
     * 
     */
    public static function deleteProduit()
    {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'DELETE FROM `76_produits` WHERE pro_id = :pro_id';

        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':pro_id', $_GET['produit'], PDO::PARAM_INT);

        $stmt->execute();
    }

    /**
     * 
     * 
     * 
     * 
     */
    public static function modifierProduit()
    {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'UPDATE `76_produits` 
                SET `pro_nom`=:pro_nom,
                `pro_description`=:pro_description,
                `pro_prix`=:pro_prix,
                `pro_quantite`=:pro_quantite
                WHERE `pro_id`=:pro_id;';

        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':pro_nom', $_POST['nom'], PDO::PARAM_STR);
        $stmt->bindValue(':pro_description', $_POST['description'], PDO::PARAM_STR);
        $stmt->bindValue(':pro_prix', $_POST['prix'], PDO::PARAM_INT);
        $stmt->bindValue(':pro_quantite', $_POST['quantite'], PDO::PARAM_INT);
        $stmt->bindValue(':pro_id', $_GET['produit'], PDO::PARAM_INT);

        $stmt->execute();
        header('Location: controller_produitAdmin.php');
        exit;

    }

    /**
     * 
     * 
     * 
     * 
     */
    public static function avoirProduitParId()
    {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'SELECT * FROM `76_produits` WHERE pro_id = :pro_id';

        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':pro_id', $_GET['produit'], PDO::PARAM_INT);

        $stmt->execute();

        $produit = $stmt->fetch(PDO::FETCH_ASSOC);

        return $produit;
    }


    /**
     * 
     * 
     * 
     * 
     */
    public static function ajouterProduit()
    {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'INSERT INTO `76_produits` (`pro_nom`, `pro_description`, `pro_prix`, `pro_quantite`, `pro_img`) 
                VALUES (:pro_nom, :pro_description, :pro_prix, :pro_quantite, :pro_img);';

        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':pro_nom', $_POST['nom'], PDO::PARAM_STR);
        $stmt->bindValue(':pro_description', $_POST['description'], PDO::PARAM_STR);
        $stmt->bindValue(':pro_prix', $_POST['prix'], PDO::PARAM_INT);
        $stmt->bindValue(':pro_quantite', $_POST['quantite'], PDO::PARAM_INT);
        $stmt->bindValue(':pro_img', $_POST['img'], PDO::PARAM_STR);

        $stmt->execute();

        return true;
    }
}
