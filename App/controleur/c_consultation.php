<?php
include 'App/modele/M_categorie.php';
include 'App/modele/M_article.php';

/**
 * Controleur pour la consultation des articles
 */
switch ($action) {
    case 'accueil':
        if(isset($_SESSION['jeux_vues'])){
           $lesJeux = $_SESSION['jeux_vues'];
        }else {
            $lesJeux = [];
        }
        break;
    case 'voirJeux':
        $categorie = filter_input(INPUT_GET, 'categorie');
        $lesJeux = M_Article::trouveLesJeuxDeCategorie($categorie);
        $_SESSION['jeux_vues'] = $lesJeux;
        break;
    case 'voirSelection':
        $lesBouquets = M_Article::trouveLesBouquetsSelectionnes();
        $lesFleurs = M_Article::trouveLesFleurSelectionnees();
        break;
    case 'voirTousLesArticles':
        $articles = M_Article::trouveLesArticles();
        break;
    case 'ajouterAuPanier':
        $idJeu = filter_input(INPUT_GET, 'jeu');
        $categorie = filter_input(INPUT_GET, 'categorie');
        if (!ajouterAuPanier($idJeu)) {
            afficheErreurs(["Ce jeu est déjà dans le panier !!"]);
        } else {
            afficheMessage("Ce jeu a été ajouté");
        }
        $lesJeux = M_Article::trouveLesArticles();
        // $lesJeux = M_Exemplaire::trouveLesJeuxDeCategorie($categorie);
        break;
    default:
        $lesJeux = [];
        break;
}

//$lesCategories = M_Categorie::trouveLesCategories();
