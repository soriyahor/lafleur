<?php

/**
 * Requetes sur les articles de fleurs
 *
 * @author 
 */
class M_Article {

    /**
     * Retourne sous forme d'un tableau associatif tous les articles 
     * @param 
     * @return un tableau associatif
     */
    public static function trouveTousLesArticles() {
        $req = "SELECT article.id, article.nom, prix, quantite_stock, photo, conditionnement_id, categorie_id1, conditionnement.nom AS typeConditionnement FROM article
        JOIN conditionnement ON article.conditionnement_id = conditionnement.id";
        $pdo=AccesDonnees::getPdo();
        $statement=$pdo->prepare($req);
        $statement->execute();

        $lesLignes = $statement->fetchAll();
        return $lesLignes;
    }
/**
 * Permets de trouver les articles par catégorie
 *
 * @param [type] $categorie
 * @return void
 */
    public static function trouveTousLesArticlesParCategorie($categorie) {
        $req = "SELECT article.id, article.nom, prix, photo, categorie_id1, quantite_stock, conditionnement.nom AS typeConditionnement FROM article
        JOIN conditionnement ON article.conditionnement_id = conditionnement.id
        WHERE categorie_id1 = :categorie";
        $pdo=AccesDonnees::getPdo();
        $statement=$pdo->prepare($req);
        $statement->bindParam('categorie', $categorie, PDO::PARAM_INT);
        $statement->execute();

        $lesLignes = $statement->fetchAll();
        return $lesLignes;
    }
/**
 * Permets de trouver les articles par couleur
 *
 * @param string $couleur
 * @return void
 */
    public static function trouveTousLesArticlesParCouleur($couleur) {
        $req = "SELECT art.id, art.nom, art.prix, art.photo, art.categorie_id1, couleur.nom AS nom_couleur, art.quantite_stock, conditionnement.nom AS typeConditionnement
        FROM article AS art 
        JOIN couleur ON art.couleur_id = couleur.id 
        JOIN conditionnement ON art.conditionnement_id = conditionnement.id
        WHERE couleur.nom = :couleur";
        $pdo=AccesDonnees::getPdo();
        $statement=$pdo->prepare($req);
        $statement->bindParam('couleur', $couleur, PDO::PARAM_STR);
        $statement->execute();

        $lesLignes = $statement->fetchAll();
        return $lesLignes;
    }

/**
 * Permets de trouver toutes les catégories
 *
 * @return void
 */
    public static function trouveLesCategories() {
        $req = "SELECT nom, id FROM categorie";
        $pdo=AccesDonnees::getPdo();
        $statement=$pdo->prepare($req);
        $statement->execute();

        $lesLignes = $statement->fetchAll();
        return $lesLignes;
    }
/**
 * Permets de trouver tous les bouquets
 *
 * @return void
 */
    public static function trouveLesBouquets() {
        $req = "SELECT art.id, art.nom, art.prix, art.photo, art.categorie_id1, conditionnement_id, art.quantite_stock, conditionnement.nom AS typeConditionnement
        FROM article AS art 
        JOIN conditionnement ON art.conditionnement_id = conditionnement.id
        WHERE conditionnement_id = 6";
        $pdo=AccesDonnees::getPdo();
        $statement=$pdo->prepare($req);
        $statement->execute();

        $lesLignes = $statement->fetchAll();
        return $lesLignes;
    }

    /**
     * Permets de trouver tous les bouquets selectionnés (selection = 1)
     * categorie5 = bouquet
     *
     * @return void
     */
    public static function trouveLesBouquetsSelectionnes() {
        $req = "SELECT article.id, article.nom, prix, quantite_stock, photo, conditionnement_id, categorie_id1, conditionnement.nom AS typeConditionnement FROM article
        JOIN conditionnement ON article.conditionnement_id = conditionnement.id 
        WHERE selection = 1 AND categorie_id1 =5";
        $pdo=AccesDonnees::getPdo();
        $statement=$pdo->prepare($req);
        $statement->execute();

        $lesLignes = $statement->fetchAll();
        return $lesLignes;
    }
/**
 * Permets de trouver toutes les fleurs selectionnés (selection = 1)
 * categorie !=5 -> ne soit pas un bouquet
 *
 * @return void
 */
    public static function trouveLesFleurSelectionnees() {
        $req = "SELECT article.id, article.nom, prix, quantite_stock, photo, conditionnement_id, categorie_id1, conditionnement.nom AS typeConditionnement FROM article
        JOIN conditionnement ON article.conditionnement_id = conditionnement.id 
        WHERE selection = 1 AND categorie_id1 !=5";
        $pdo=AccesDonnees::getPdo();
        $statement=$pdo->prepare($req);
        $statement->execute();

        $lesLignes = $statement->fetchAll();
        return $lesLignes;
    }
   /**
    * Permet de trouver toutes les couleurs
    *
    * @return void
    */
    public static function trouveToutesLesCouleurs() {
        $req = "SELECT * FROM couleur";
        $pdo=AccesDonnees::getPdo();
        $statement=$pdo->prepare($req);
        $statement->execute();

        $lesLignes = $statement->fetchAll();
        return $lesLignes;
    }
    /**
     * Retourne les articles concernés par le tableau des idProduits passée en argument
     *
     * @param $desIdArticles tableau d'idProduits
     * @return un tableau associatif
     */
    public static function trouveLesArticlesDuTableau($desIdArticles) {
        $nbArticles = count($desIdArticles);
        $lesArticles = array();
        if ($nbArticles != 0) {
            foreach ($desIdArticles as $unIdArticle => $quantite) {
                
                $req = "SELECT id, nom, prix, quantite_stock, photo, categorie_id1 FROM article WHERE id = :unIdArticle";
                $pdo=AccesDonnees::getPdo();
                $statement=$pdo->prepare($req);
                $statement->bindParam('unIdArticle', $unIdArticle, PDO::PARAM_INT);
                $statement->execute();
            
                $unArticle = $statement->fetch();
                $unArticle['quantite']=$quantite;
                
                $lesArticles[] = $unArticle;
            }
        }
        return $lesArticles;
    }

    public static function trouveLesArticles(){
        $res = AccesDonnees::query("SELECT * from article");
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }
}
