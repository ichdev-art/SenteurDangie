<?php
class Produits
{
    /**
     * Récupère tous les produits de la base de données.
     * 
     * @return array Liste des produits avec nom, image, description, prix, quantité et ID.
     */
    public static function afficherProduit()
    {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'SELECT pro_id,pro_nom,pro_img,pro_description,pro_prix,pro_quantite 
        from `76_produits`';

        $stmt = $pdo->prepare($sql);


        $stmt->execute();

        $bougieProduit = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $bougieProduit;
    }

    /**
     * Récupère les informations d'un produit spécifique ainsi que les avis associés.
     * 
     * @return array Informations détaillées du produit et de ses avis (nom, prix, description, auteur, date, etc.).
     */
    public static function afficherUnProduit()
    {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'SELECT p.pro_id,pro_nom,pro_img,pro_description,pro_prix,pro_quantite,avi_description,avi_date,use_nom,use_prenom 
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
     * Récupère toutes les commandes passées par l'utilisateur connecté.
     * 
     * @return array Liste structurée des commandes avec produits associés, dates et total.
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
                    cl.comlig_quantité
                FROM 76_commande c
                JOIN 76_users u ON c.use_id = u.use_id
                JOIN 76_commande_ligne cl ON c.com_id = cl.com_id
                JOIN 76_produits p ON cl.pro_id = p.pro_id
                where u.use_id = :use_id';

        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':use_id', $_SESSION['user']['id'], PDO::PARAM_INT);

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
                'comlig_quantité' => $row['comlig_quantité']
            ];

            // Calculer le total de la commande en multipliant le prix du produit par la quantite

            $commandes[$com_id]['total'] += $row['pro_prix'] * $row['comlig_quantité'];
        }

        // Réinitialiser les clés du tableau pour qu'elles soient continues
        return $commandes;
    }

    /**
     * Supprime un produit de la base de données à partir de son ID passé en GET.
     * 
     * @return void
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
     * Met à jour les informations d’un produit à partir des données POST et de l’ID passé en GET.
     * 
     * @return void Redirige vers la page d'administration des produits après modification.
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
     * Récupère les détails d’un produit spécifique selon son ID.
     * 
     * @return array Données complètes du produit (nom, prix, quantité, image...).
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
     * Ajoute un nouveau produit à la base de données avec une image uploadée.
     * 
     * @return true|string Retourne true si succès, ou un message d’erreur si échec.
     */
    public static function ajouterProduit()
    {

        if (!isset($_FILES['img']) || $_FILES['img']['error'] !== 0) {
            // Erreur d'upload
            return 'Erreur de téléchargement de l\'image.';
        }

        // Vérification du type de fichier (tu peux ajuster selon les types que tu veux accepter)
        $allowed = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($_FILES['img']['type'], $allowed)) {
            return 'Type de fichier non valide. Seules les images JPG, PNG et GIF sont autorisées.';
        }


        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Génération du nom de fichier unique
        $fileName = uniqid() . '_' . $_FILES['img']['name'];
        $fileTmpName = $_FILES['img']['tmp_name'];

        // Déplacement du fichier
        $filePath = '../../assets/img/' . $fileName;
        if (!move_uploaded_file($fileTmpName, $filePath)) {
            // Erreur lors du déplacement du fichier
            return 'Erreur lors de l\'upload de l\'image.';
        }


        // Préparation de la requête d'insertion
        $sql = 'INSERT INTO `76_produits` (`pro_nom`, `pro_description`, `pro_prix`, `pro_quantite`, `pro_img`) 
                VALUES (:pro_nom, :pro_description, :pro_prix, :pro_quantite, :pro_img);';

        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':pro_nom', $_POST['nom'], PDO::PARAM_STR);
        $stmt->bindValue(':pro_description', $_POST['description'], PDO::PARAM_STR);
        $stmt->bindValue(':pro_prix', $_POST['prix'], PDO::PARAM_INT);
        $stmt->bindValue(':pro_quantite', $_POST['quantite'], PDO::PARAM_INT);
        $stmt->bindValue(':pro_img', $fileName, PDO::PARAM_STR);

        $stmt->execute();

        return true;
    }

    /**
     * Récupère toutes les commandes de tous les utilisateurs.
     * 
     * @return array Liste des commandes avec détails sur l'utilisateur, produits et quantités.
     */
    public static function afficherToutecommande()
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
            SUM(p.pro_prix * cl.comlig_quantité) AS total,
            SUM(cl.comlig_quantité) AS nb_produits
        FROM 76_commande c
        JOIN 76_users u ON c.use_id = u.use_id
        JOIN 76_commande_ligne cl ON c.com_id = cl.com_id
        JOIN 76_produits p ON cl.pro_id = p.pro_id
        GROUP BY c.com_id
        ORDER BY c.com_dateCommande DESC';

        $stmt = $pdo->prepare($sql);

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

        return $command;
    }

    public static function afficherDetailCommande($commandeId) {
    $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT 
                p.pro_nom,
                p.pro_description,
                p.pro_prix,
                p.pro_img,
                cl.comlig_quantité
            FROM 76_commande_ligne cl
            JOIN 76_produits p ON cl.pro_id = p.pro_id
            WHERE cl.com_id = :id';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $commandeId, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}
