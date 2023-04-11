<?php

/**
 * Requetes sur les exemplaires  de jeux videos
 *
 * @author 
 */
class M_Article {

    const sql = "SELECT e.id, j.nom, statut, description, prix, image, id_categories FROM exemplaires as e
    join jeu as j on j.id=e.id_jeu join etat as et on et.id=e.id_etat ";

    /**
     * Retourne sous forme d'un tableau associatif tous les jeux de la
     * catégorie passée en argument
     *
     * @param $idCategorie
     * @return un tableau associatif
     */
    public static function trouveTousLesArticles() {
        $req = "SELECT id, nom, prix, photo, categorie_id1 FROM article";
        $pdo=AccesDonnees::getPdo();
        $statement=$pdo->prepare($req);
        $statement->execute();

        $lesLignes = $statement->fetchAll();
        return $lesLignes;
    }

    public static function trouveTousLesArticlesParCategorie($categorie) {
        $req = "SELECT id, nom, prix, photo, categorie_id1 FROM article WHERE categorie_id1 = :categorie";
        $pdo=AccesDonnees::getPdo();
        $statement=$pdo->prepare($req);
        $statement->bindParam('categorie', $categorie, PDO::PARAM_INT);
        $statement->execute();

        $lesLignes = $statement->fetchAll();
        return $lesLignes;
    }

    public static function trouveTousLesArticlesParCouleur($couleur) {
        $req = "SELECT art.id, art.nom, art.prix, art.photo, art.categorie_id1, couleur.nom AS nom_couleur FROM article AS art JOIN couleur ON art.couleur_id = couleur.id WHERE couleur.nom = :couleur";
        $pdo=AccesDonnees::getPdo();
        $statement=$pdo->prepare($req);
        $statement->bindParam('couleur', $couleur, PDO::PARAM_STR);
        $statement->execute();

        $lesLignes = $statement->fetchAll();
        return $lesLignes;
    }


    public static function trouveLesCategories() {
        $req = "SELECT nom, id FROM categorie";
        $pdo=AccesDonnees::getPdo();
        $statement=$pdo->prepare($req);
        $statement->execute();

        $lesLignes = $statement->fetchAll();
        return $lesLignes;
    }

    public static function trouveLesBouquets() {
        $req = "SELECT art.id, art.nom, art.prix, art.photo, art.categorie_id1, conditionnement_id FROM article AS art WHERE conditionnement_id = 6";
        $pdo=AccesDonnees::getPdo();
        $statement=$pdo->prepare($req);
        $statement->execute();

        $lesLignes = $statement->fetchAll();
        return $lesLignes;
    }

    public static function trouveLesBouquetsSelectionnes() {
        $req = "SELECT id, nom, prix, photo, categorie_id1 FROM article WHERE selection = 1 AND categorie_id1 =5";
        $pdo=AccesDonnees::getPdo();
        $statement=$pdo->prepare($req);
        $statement->execute();

        $lesLignes = $statement->fetchAll();
        return $lesLignes;
    }

    public static function trouveLesFleurSelectionnees() {
        $req = "SELECT id, nom, prix, photo, categorie_id1 FROM article WHERE selection = 1 AND categorie_id1 =1";
        $pdo=AccesDonnees::getPdo();
        $statement=$pdo->prepare($req);
        $statement->execute();

        $lesLignes = $statement->fetchAll();
        return $lesLignes;
    }
   
    public static function trouveToutesLesCouleurs() {
        $req = "SELECT * FROM couleur";
        $pdo=AccesDonnees::getPdo();
        $statement=$pdo->prepare($req);
        $statement->execute();

        $lesLignes = $statement->fetchAll();
        return $lesLignes;
    }
    /**
     * Retourne les jeux concernés par le tableau des idProduits passée en argument
     *
     * @param $desIdJeux tableau d'idProduits
     * @return un tableau associatif
     */
    public static function trouveLesArticlesDuTableau($desIdArticles) {
        $nbArticles = count($desIdArticles);
        $lesArticles = array();
        if ($nbArticles != 0) {
            foreach ($desIdArticles as $unIdArticle => $quantite) {
                
                $req = "SELECT id, nom, prix, photo, categorie_id1 FROM article WHERE id = :unIdArticle";
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
