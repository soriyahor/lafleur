<?php

/**
 * Requetes sur les commandes
 *
 */
class M_Commande
{

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
        if(!isset($_SESSION['client'])){
            $erreurs[] = "Connectez-vous !";
            return $erreurs;
        }
        
        $idClient = $_SESSION['client']->getId();
        // var_dump($_SESSION);
        $reqCommande = "insert into commande_clt(client_id) values (:idClient)";
        $pdo=AccesDonnees::getPdo();
        $statement=$pdo->prepare($reqCommande);
        $statement->bindParam(':idClient', $idClient, PDO::PARAM_INT);
        $statement->execute();
        $resCommande = $statement->fetch(PDO::FETCH_ASSOC);


        // AccesDonnees::exec($reqCommande);
        $idCommande = AccesDonnees::getPdo()->lastInsertId();

        foreach ($listArticles as $article) {
            $reqArticle = "SELECT * from article where id = :article";
            $pdo=AccesDonnees::getPdo();
            $statement=$pdo->prepare($reqArticle);
            $statement->bindParam(':article',$article, PDO::PARAM_INT);
            $statement->execute();
            $articleBDD = $statement->fetch(PDO::FETCH_ASSOC);
            $prix = $articleBDD['prix'];

            $req = "insert into ligne_commande_clt(article_id, commande_clt_id, quantite, prix) values ('$idCommande','$article','quantite' '$prix')";
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

        $reqCommande = "select co.id, co.created_at, co.id_clients,
        lc.quantite, lc.prix,
        etat.statut,
        jeu.nom as nom_jeu, jeu.description, jeu.version,
        console.nom as nom_console, ca.nom as cat
        from commandes as co
        join lignes_commande as lc
        on co.id = lc.commande_id
        join exemplaires as ex
        on lc.exemplaire_id = ex.id
        join jeu
        on ex.id_jeu = jeu.id
        join etat
        on etat.id = ex.id_etat
        join console
        on jeu.id_console = console.id
        join categories as ca
        on ca.id = jeu.id_categories
        where id_clients = :idClient
        order by id desc";
        $idClient = $_SESSION['client']->getId();
        $pdo=AccesDonnees::getPdo();
        $statement=$pdo->prepare($reqCommande);
        $statement->bindParam(':idClient',$idClient, PDO::PARAM_INT);
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
