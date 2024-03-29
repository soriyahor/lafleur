<?php

/**
 * Initialise le panier
 *
 * Crée une variable de type session dans le cas
 * où elle n'existe pas 
 */
function initPanier() {
    if (!isset($_SESSION['articles'])) {
        $_SESSION['articles'] = array();
    }
}

/**
 * Supprime le panier
 *
 * Supprime la variable de type session 
 */
function supprimerPanier() {
    unset($_SESSION['articles']);
}

/**
 * Ajoute un article au panier
 *
 * Teste si l'identifiant de l'article est déjà dans la variable session 
 * ajoute l'identifiant à la variable de type session dans le cas où
 * où l'identifiant de l'article n'a pas été trouvé
 * @param $idArticle : identifiant de l'article
 * @return vrai si l'article n'était pas dans la variable, faux sinon 
 */
function ajouterAuPanier($idArticle, int $quantite) {
    afficheMessage("Cet article a été ajouté");
    if (!isset($_SESSION['articles'][$idArticle])) {
        $_SESSION['articles'][$idArticle] = intval($quantite);
    } else {
        $val = $_SESSION['articles'][$idArticle];
        $sum = intval($val) + intval($quantite);
        $_SESSION['articles'][$idArticle] = $sum;
    }
    
    
}

/**
 * Retourne les article du panier
 *
 * Retourne le tableau des identifiants de l'article
 * @return : le tableau
 */
function getLesIdArticlesDuPanier() {
    return $_SESSION['articles'];
}

/**
 * Retourne le nombre d'article du panier
 *
 * Teste si la variable de session existe
 * et retourne le nombre d'éléments de la variable session
 * @return : le nombre 
 */
function nbArticlesDuPanier() {
    $n = 0;
    if (isset($_SESSION['articles'])) {
        $n = count($_SESSION['articles']);
    }
    return $n;
}

/**
 * Retire un des articles du panier
 *
 * Recherche l'index de l'idArticle dans la variable session
 * et détruit la valeur à ce rang
 * @param $idArticle : identifiant de l'article

 */
function retirerDuPanier($idArticle) {
    unset($_SESSION['articles'][$idArticle]);
}

/**
 * Affiche une liste d'erreur
 * @param array $msgErreurs
 */
function afficheErreurs(array $msgErreurs) {
    echo '﻿<div class="erreur"><ul>';
    foreach ($msgErreurs as $erreur) {
        ?>     
        <li><?php echo $erreur ?></li>
        <?php
    }
    echo '</ul></div>';
}

/**
 * Affiche un message bleu
 * @param string $msg
 */
function afficheMessage(string $msg) {
    echo '﻿<div class="message">'.$msg.'</div>';
}

/**
 * Si email existe
 *
 * @param String $str
 * @return boolean
 */
function is_existe(String $str):bool
{
    return isset($str) && !empty($str);
}
