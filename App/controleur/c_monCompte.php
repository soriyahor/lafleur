<?php

include 'App/modele/M_Compte.php';
include 'App/modele/M_Commande.php';

/**
 * Controleur pour se connecter
 * @author Loic LOG
 */
switch ($action) {
    case 'historique':
        if (isset($_SESSION['client'])) {
            $commandes = M_Commande::voirCommandes();
        }else{
            $commandes = [];
        }
        break;
    case 'inscription':
        $nom = filter_input(INPUT_POST, 'nom');
        $prenom = filter_input(INPUT_POST, 'prenom');
        $numRue = filter_input(INPUT_POST, 'numRue');
        $rue = filter_input(INPUT_POST, 'rue');
        $ville = filter_input(INPUT_POST, 'ville');
        $cp = filter_input(INPUT_POST, 'cp');
        $mail = filter_input(INPUT_POST, 'mail');
        $mdp = filter_input(INPUT_POST, 'mdp');
        $confirmMdp = filter_input(INPUT_POST, 'confirmMdp');

        $errors = M_Compte::estValide($nom, $prenom, $numRue, $rue, $ville, $cp, $mail, $mdp);
        if (count($errors) > 0) {
            // Si une erreur, on recommence
            afficheErreurs($errors);
        } if($mdp === $confirmMdp){
            M_Compte::CreerInscription($nom, $prenom, $numRue, $rue, $cp, $ville, $mail, $mdp);
            afficheMessage("Votre compte est créé");
            $uc = '';
        }else {
            afficheMessage("Vous n'avez pas le même mot de passe. Veuillez recommencer.");
        }
        break;
    case 'connexion':
        $mail = filter_input(INPUT_POST, 'mail');
        $mdp = filter_input(INPUT_POST, 'mdp');
        $errors = M_Session::connexionValide($mail, $mdp);
        if (count($errors) > 0) {
            // Si une erreur, on recommence
            afficheErreurs($errors);
        } else {
            afficheMessage("Vous etes connecté");
            $uc = '';
            if(!isset($_SESSION['client'])){
                $utilisateur = M_Compte::recupererUtilisateur($mail);
                $client = new Client($utilisateur['id'], $utilisateur['nom'], date('\l\e d/m/Y à H:i:s'), $mail);
                $_SESSION['client'] = $client;
            }
        }
        break;
    case 'deconnexion':
        M_Session::deconnexion();
        break;
}
