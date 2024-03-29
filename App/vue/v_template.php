<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./public/style.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAFLEUR</title>
</head>

<body>
    <?php

    include 'v_navigation.php';

    if (!isset($uc)) {
        include 'v_accueil.php';
    }

    switch ($uc) {
        case 'json':
             //renvoi pas de page pour de l'ajax
            break;
        case 'accueil':
            include 'v_accueil.php';
            break;
        case 'nosFleurs':
            include 'v_nosFleurs.php';
            break;
        case 'quiSommesNous':
            include 'v_quiSommesNous.php';
            break;
        case 'contact':
            include 'v_contact.php';
            break;
        case 'compte':
            include 'v_compte.php';
            break;
        case 'panier':
            include 'v_panier.php';
            break;
        case 'commandes':
            include 'v_commandes.php';
            break;
        case 'jeuCasino':
            include 'v_jeuCasino.php';
            break;
        case '':
            include 'v_accueil.php';
            break;
        case 'blog':
            include 'v_blog.php';
            break;
        // default:
        // include 'v_404.php';
        // die();
    }

    include 'v_footer.php';

    ?>
    <script src="./public/main.js"></script>
</body>

</html>