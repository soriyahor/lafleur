<?php
include 'App/modele/M_Article.php';
/**
 * Controleur pour la gestion du panier
 * 
 */

$lesArticlesDuPanier = [];

switch ($action) {
    case 'supprimerUnArticle':
        $idArticle = filter_input(INPUT_GET, 'article');
        retirerDuPanier($idArticle);
    case 'voirPanier':
        if (isset($_SESSION['client'])){
            $client = $_SESSION['client'];
        } else {
            $client = null;
        }
        
        $n = nbArticlesDuPanier();
        if ($n > 0) {
            $desIdArticle = getLesIdArticlesDuPanier();
            $lesArticlesDuPanier = M_Article::trouveLesArticlesDuTableau($desIdArticle);
        } else {
            afficheMessage("Panier Vide !!");
            $uc = 'panier';
        }
        break;
}



