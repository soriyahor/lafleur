<?php

include 'App/modele/M_commande.php';

/**
 * Controleur pour les commandes
 * 
 */
switch ($action) {
    case 'passerCommande':
        $n = nbArticlesDuPanier();
        if ($n > 0) {
            $nom = '';
            $prenom = '';
            $numRue = '';
            $rue = '';
            $ville = '';
            $cp = '';
            $mail = '';
        } else {
            afficheMessage("Panier vide !!");
            $uc = '';
        }
        break;
    case 'confirmerCommande':
        $lesIdArticle = getLesIdArticlesDuPanier();
        $errors = M_Commande::creerCommande($lesIdArticle);
        if (count($errors) > 0) {
            afficheErreurs($errors);
        } else {
            supprimerPanier();
            afficheMessage("Commande enregistrée");
        }

        break;
}
