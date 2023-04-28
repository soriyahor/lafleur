<?php

include 'App/modele/M_commande.php';
include 'App/modele/M_Loterie.php';

/**
 * Controleur pour les commandes
 * 
 */
switch ($action) {
    case 'trouverToutesLesLoteries':
        $loteries = M_Loterie::findAll();
        $data = preg_replace('/^%EF%BB%BF/', '', json_encode($loteries));
        echo $data;
        break;
    case 'jeuCasino':
        $dateLivraison = filter_input(INPUT_GET, 'dateLivraison');
        $loteries = M_Loterie::findAll();
        break;
    case 'passerCommande':
        $dateLivraison = filter_input(INPUT_GET, 'dateLivraison');
        $idLoterie = filter_input(INPUT_GET, 'idLoterie');

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

        $lesIdArticle = getLesIdArticlesDuPanier();
        $errors = M_Commande::creerCommande($lesIdArticle, $dateLivraison, $idLoterie);
        if (count($errors) > 0) {
            afficheErreurs($errors);
        } else {
            supprimerPanier();
            afficheMessage("Commande enregistrée");
        }

        break;
}
