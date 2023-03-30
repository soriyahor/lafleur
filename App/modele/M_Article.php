<?php

/**
 * Requetes sur les exemplaires  de jeux videos
 *
 * @author Loic LOG
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
    public static function trouveLesJeuxDeCategorie($idCategorie) {
        $req = self::sql."WHERE id_categories = :idCat";
        // $req = "SELECT * FROM exemplaires WHERE categorie_id = '$idCategorie'";
        // $res = AccesDonnees::query($req);
        $pdo=AccesDonnees::getPdo();
        $statement=$pdo->prepare($req);
        $statement->bindParam(':idCat',$idCategorie, PDO::PARAM_INT);
        $statement->execute();

        $lesLignes = $statement->fetchAll();
        return $lesLignes;
    }

    public static function trouveLesArticlesSelectionnes() {
        $req = "SELECT nom, prix, photo, categorie_id1 FROM article WHERE selection = 1 AND categorie_id1 =5";
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
    public static function trouveLesJeuxDuTableau($desIdJeux) {
        $nbProduits = count($desIdJeux);
        $lesProduits = array();
        if ($nbProduits != 0) {
            foreach ($desIdJeux as $unIdProduit) {
                $req = self::sql."WHERE e.id = :unIdProduit";
                $pdo=AccesDonnees::getPdo();
                $statement=$pdo->prepare($req);
                $statement->bindParam('unIdProduit', $unIdProduit, PDO::PARAM_INT);
                $statement->execute();
                // $res = AccesDonnees::query($req);
                $unProduit = $statement->fetch();
                $lesProduits[] = $unProduit;
            }
        }
        return $lesProduits;
    }

    public static function trouveLesArticles(){
        $res = AccesDonnees::query("SELECT * from article");
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }
}
