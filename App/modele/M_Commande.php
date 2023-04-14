<?php

/**
 * Requetes sur les commandes
 *
 */
class M_Commande
{



public static function creerLivraison($idClient, $prixLivraison){

    $reqLivraison = "SELECT numero, rue, complement, cp, nom, livrable
        FROM adresse_client 
        JOIN adresse ON adresse_client.adresse_id = adresse.id 
        JOIN ville ON adresse.ville_id = ville.id 
        JOIN codepostal ON adresse.codePostal_id = codepostal.id
        WHERE client_id= :idClient";
        $pdo = AccesDonnees::getPdo();
        $statement = $pdo->prepare($reqLivraison);
        $statement->bindParam(':idClient', $idClient, PDO::PARAM_INT);
        $statement->execute();
        $resLivraison = $statement->fetch(PDO::FETCH_ASSOC);

        $livrable = $resLivraison['livrable'];
        
        if($livrable == 0){
            return -1;
        }

        $dateActuelle = date('Y-m-d', strtotime('+2 days'));
        $numRue = $resLivraison['numero'];
        $rue = $resLivraison['rue'];
        $complement = $resLivraison['complement'];
        $code_postal = $resLivraison['cp'];
        $ville = $resLivraison['nom'];

        $reqRajoutLivraison = "INSERT INTO livraison (date_livraison, etat_livraison, numero_rue, rue, complement, code_postal, ville, prix)
         values (:dateActuelle,'en cours de livraison', :numRue, :rue, :complement, :code_postal, :ville, :prixLivraison)";
        $pdo = AccesDonnees::getPdo();
        $statement = $pdo->prepare($reqRajoutLivraison);
        $statement->bindParam(':dateActuelle', $dateActuelle, PDO::PARAM_STR);
        $statement->bindParam(':numRue', $numRue, PDO::PARAM_INT);
        $statement->bindParam(':rue', $rue, PDO::PARAM_STR);
        $statement->bindParam(':complement', $complement, PDO::PARAM_STR);
        $statement->bindParam(':code_postal', $code_postal, PDO::PARAM_INT);
        $statement->bindParam(':ville', $ville, PDO::PARAM_STR);
        $statement->bindParam(':prixLivraison', $prixLivraison, PDO::PARAM_STR);
        $statement->execute();
        
        $idLivraison = AccesDonnees::getPdo()->lastInsertId();

return $idLivraison;
}


    /**
     * Crée une commande
     *
     * Crée une commande à partir des arguments validés passés en paramètre, l'identifiant est
     * construit à partir du maximum existant ; crée les lignes de commandes dans la table contenir à partir du
     * tableau d'idProduit passé en paramètre
     * @param $nom
     * @param $rue
     * @param $cp
     * @param $ville
     * @param $mail
     * @param $listJeux

     */
    public static function creerCommande($listArticles)
    {
        $erreurs = [];
        if (!isset($_SESSION['client'])) {
            $erreurs[] = "Connectez-vous !";
            return $erreurs;
        }
        $idClient = $_SESSION['client']->getId();

        $somme = 0;
        foreach ($_SESSION['articles'] as $idArticle => $quantite) {
            $reqArticle = "SELECT * from article where id = :article";
            $pdo = AccesDonnees::getPdo();
            $statement = $pdo->prepare($reqArticle);
            $statement->bindParam(':article', $idArticle, PDO::PARAM_INT);
            $statement->execute();
            $articleBDD = $statement->fetch(PDO::FETCH_ASSOC);
            $prix = $articleBDD['prix'];

            $somme += $prix*intval($quantite);

        }
        
        $prixLivraison = 0;
        if($somme<50){
            $prixLivraison = 2.99;
        }
        $idLivraison = M_Commande::creerLivraison($idClient, $prixLivraison);


        if($idLivraison == -1 ){
            $erreurs[] = "Nous sommes désolé, nous ne déservons pas votre ville !";
            return $erreurs;
        }
        // var_dump($_SESSION);
        $reqCommande = "insert into commande_clt(client_id, livraison_id) values (:idClient, :idLivraison)";
        $pdo = AccesDonnees::getPdo();
        $statement = $pdo->prepare($reqCommande);
        $statement->bindParam(':idClient', $idClient, PDO::PARAM_INT);
        $statement->bindParam(':idLivraison', $idLivraison, PDO::PARAM_INT);
        $statement->execute();
        $resCommande = $statement->fetch(PDO::FETCH_ASSOC);

        // AccesDonnees::exec($reqCommande);
        $idCommande = AccesDonnees::getPdo()->lastInsertId();

        foreach ($_SESSION['articles'] as $idArticle => $quantite) {
            $reqArticle = "SELECT * from article where id = :article";
            $pdo = AccesDonnees::getPdo();
            $statement = $pdo->prepare($reqArticle);
            $statement->bindParam(':article', $idArticle, PDO::PARAM_INT);
            $statement->execute();
            $articleBDD = $statement->fetch(PDO::FETCH_ASSOC);
            $prix = $articleBDD['prix'];


            $req = "insert into ligne_commande_clt(article_id, commande_clt_id, quantite, prix) values ('$idArticle', '$idCommande','$quantite' '$prix')";
            AccesDonnees::exec($req);
        }
        return $erreurs;
    }
    /**
     * voir l'historique des commandes
     *
     * @return void
     */
    public static function voirCommandes()
    {

        $reqCommande = "SELECT commande_clt.id AS id_commande, commande_clt.date_commande, commande_clt.client_id, 
         lc.quantite, lc.prix, article.nom AS article, couleur.nom AS couleur
        FROM commande_clt 
        JOIN ligne_commande_clt AS lc ON lc.commande_clt_id = commande_clt.id 
        JOIN livraison ON commande_clt.livraison_id = livraison.id
        JOIN article ON lc.article_id = article.id join conditionnement on article.conditionnement_id= conditionnement.id 
        JOIN couleur on couleur.id = article.couleur_id 
        JOIN categorie ON article.categorie_id1 = categorie.id
        WHERE client_id=:idClient
        ORDER BY id_commande DESC";
       
        $idClient = $_SESSION['client']->getId();
        $pdo = AccesDonnees::getPdo();
        $statement = $pdo->prepare($reqCommande);
        $statement->bindParam(':idClient', $idClient, PDO::PARAM_INT);
        $statement->execute();
        $resCommande = $statement->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($resCommande);
        return $resCommande;
    }

    /**
     * Retourne vrai si pas d'erreur
     * Remplie le tableau d'erreur s'il y a
     *
     * @param $nom : chaîne
     * @param $rue : chaîne
     * @param $ville : chaîne
     * @param $cp : chaîne
     * @param $mail : chaîne
     * @return : array
     */
    public static function estValide($nom, $prenom, $numRue, $rue, $ville, $cp, $mail)
    {
        $erreurs = [];
        if ($nom == "") {
            $erreurs[] = "Il faut saisir le champ nom";
        }
        if ($prenom == "") {
            $erreurs[] = "Il faut saisir le champ prenom";
        }
        if ($rue == "") {
            $erreurs[] = "Il faut saisir le champ rue";
        }
        if ($ville == "") {
            $erreurs[] = "Il faut saisir le champ ville";
        }
        if ($cp == "") {
            $erreurs[] = "Il faut saisir le champ Code postal";
        } else if (!estUnCp($cp)) {
            $erreurs[] = "erreur de code postal";
        }
        if ($mail == "") {
            $erreurs[] = "Il faut saisir le champ mail";
        } else if (!estUnMail($mail)) {
            $erreurs[] = "erreur de mail";
        }
        return $erreurs;
    }
}
