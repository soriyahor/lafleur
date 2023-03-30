<?php

include 'App/modele/M_commande.php';

/**
 * Controleur pour les commandes
 * @author Loic LOG
 */
switch ($action) {
    case 'passerCommande':
        $n = nbJeuxDuPanier();
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
        $lesIdJeu = getLesIdJeuxDuPanier();
        $errors = M_Commande::creerCommande($lesIdJeu);
        if (count($errors) > 0) {
            afficheErreurs($errors);
        } else {
            supprimerPanier();
            afficheMessage("Commande enregistrée");
        }

        break;
}
