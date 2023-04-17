<header>

    <nav id="navbar">

        <div class="barrefixe">
            <div>00.00.00.00.00</div>
            <?php
            ?>
            <div class="commerce">
                <div><a href="index.php?uc=commandes&action=historique"> Voir mes commandes </a></div>
                <div><a href="index.php?uc=compte" class="lienCompte">Compte</a></div>
                <?php
                if (isset($_SESSION['client'])) {
                    echo $_SESSION['client']->getNom();
                }
                ?>
                <?php
                if (isset($_SESSION['client'])) {
                ?> <div><a href="index.php?uc=deconnexion&action=deconnexion">Déconnexion</a></div>
                <?php
                }
                ?>
                <div class="panier"><a href="index.php?uc=panier&action=voirPanier"> Panier</a></div>
            </div>

        </div>
        <a href="index.php?uc=accueil">
            <div class="logo">

                <img src="./public/images/lafleur.png" alt="logo_lafleur" class="imgLogo">

            </div>
        </a>
        <div class="containerNav">
            <div class="navbar">
                <ul class="navUl">
                    <li class="navLi bye smallScreen"><a class="lien" href="index.php?uc=accueil&action=voirSelection">Accueil</a></li>
                    <li class="navLi bye smallScreen"><a class="lien" href="index.php?uc=nosFleurs&action=voirTousLesArticles">Nos fleurs</a></li>
                    <li class="navLi bye smallScreen"><a class="lien" href="index.php?uc=quiSommesNous">Qui sommes nous ?</a></li>
                    <li class="navLi bye smallScreen"><a class="lien" href="index.php?uc=blog">Blog</a></li>
                    <li class="navLi bye smallScreen"><a class="lien" href="index.php?uc=contact">Contact</a></li>
                </ul>
            </div>
            <div class="box">
                <div class="cont-lignes btn1">
                    <div class="lignes"></div>
                    <div class="lignes"></div>
                    <div class="lignes"></div>
                </div>
            </div>
    </nav>
    <div class="banniere">
        <img src="./public/images/entete.jpg" alt="enteteLafleur" class="imgBanniere">
    </div>

</header>