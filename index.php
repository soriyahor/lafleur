<?php

// Pour afficher les erreurs PHP
error_reporting(E_ALL);
ini_set("display_errors", 1);
// Attention : A supprimer en production !!!
require("./util/Client.php");
require("./util/fonctions.inc.php");
require('./util/validateurs.inc.php');
require("./App/modele/AccesDonnees.php");

session_start();

$uc = filter_input(INPUT_GET, 'uc'); // Use Case
$action = filter_input(INPUT_GET, 'action'); // Action
$json = filter_input(INPUT_GET, 'json'); // mode APi json
initPanier();

if (!$uc) {
    $uc = 'accueil';
}
if(!$action && $uc == 'accueil' ){
    $action = 'voirSelection';

}

// Controleur principale
switch ($uc) {
    case 'accueil':
        include 'App/controleur/c_consultation.php';
        break;
    case 'nosFleurs':
        include 'App/controleur/c_consultation.php';
        break;
    case 'panier':
        include 'App/controleur/c_gestionPanier.php';
        break;
    case 'commander':
        include 'App/controleur/c_passerCommande.php';
        break;
    case 'inscrire':
        include 'App/controleur/c_monCompte.php';
        break;
    case 'commandes':
        include 'App/controleur/c_monCompte.php';
        break;
    case 'deconnexion':
        include 'App/controleur/c_monCompte.php';
        break;
    default:
        break;
}

if(!isset($json)){
    include("App/vue/v_template.php");
}else {
    header("Content-Type: application/json");
}

