<?php
include 'App/modele/M_article.php';
/**
 * Controleur pour la gestion du panier
 * @author Loic LOG
 */
switch ($action) {
    case 'supprimerUnJeu':
        $idJeu = filter_input(INPUT_GET, 'jeu');
        retirerDuPanier($idJeu);
    case 'voirPanier':
        $n = nbJeuxDuPanier();
        if ($n > 0) {
            $desIdJeu = getLesIdJeuxDuPanier();
            $lesJeuxDuPanier = M_Article::trouveLesJeuxDuTableau($desIdJeu);
        } else {
            afficheMessage("Panier Vide !!");
            $uc = '';
        }
        break;
}



