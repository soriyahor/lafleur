<?php
include 'App/modele/M_categorie.php';
include 'App/modele/M_article.php';

/**
 * Controleur pour la consultation des articles
 */
switch ($action) {
    case 'accueil':
        $lesBouquets = M_Article::trouveLesBouquetsSelectionnes();
        $lesFleurs = M_Article::trouveLesFleurSelectionnees();
        break;
    case 'voirTousLesArticles':
        $categorie = filter_input(INPUT_GET, 'categorie'); 
        $couleur = filter_input(INPUT_GET, 'couleur');  
        $lesArticles = M_Article::trouveTousLesArticles();
        $lesCategories = M_Categorie::trouveTousLesCategories();
        
        break;
    case 'voirParCategorie':
            $categorie = filter_input(INPUT_GET, 'categorie');  
            $lesArticles = M_Article::trouveTousLesArticlesParCategorie($categorie);
        break;  
    case 'voirParCouleur':
        $couleur = filter_input(INPUT_GET, 'couleur'); 
        $lesArticles = M_Article::trouveTousLesArticlesParCouleur($couleur);
        // $lesCouleurs = M_article::trouveToutesLesCouleurs();
        break;  
    case 'voirSelection':
        $lesBouquets = M_Article::trouveLesBouquetsSelectionnes();
        $lesFleurs = M_Article::trouveLesFleurSelectionnees();
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
$lesCouleurs = M_article::trouveToutesLesCouleurs();
$lesCategories = M_Categorie::trouveTousLesCategories();
