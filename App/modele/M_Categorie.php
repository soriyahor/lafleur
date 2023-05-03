<?php

/**
 * Les articles sont rangés par catégorie
 *
 * 
 */
class M_Categorie {

    /**
     * Retourne toutes les catégories sous forme d'un tableau associatif
     *
     * @return le tableau associatif des catégories
     */
    public static function trouveTousLesCategories() {
        $req = "SELECT nom, id FROM categorie";
        $res = AccesDonnees::query($req);
    $lesLignes = $res->fetchAll();
    return $lesLignes;
    }
}
