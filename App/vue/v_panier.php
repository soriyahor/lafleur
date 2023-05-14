<main>
    <h1 class="titrePanier">Panier</h1>

    <div class="containPanier">
        <?php
        foreach ($lesArticlesDuPanier as $unArticle) {
            $idArticle = $unArticle['id'];
            $nom = $unArticle['nom'];
            $photo = $unArticle['photo'];
            $prix = $unArticle['prix'];
            $quantite = $unArticle['quantite'];
        ?>
            <p>
                <img src="./public/photo/<?= $photo ?>" alt="Image d'article fleuriste" class="imgVtePanier" width="200" height="150">
                <?php
                echo $nom . "($prix Euros)";
                echo $quantite . " (quantite)";

                ?>
                <a class="retirerPanier" href="index.php?uc=panier&article=<?php echo $idArticle ?>&action=supprimerUnArticle" onclick="return confirm('Voulez-vous vraiment retirer cet article ?');">
                    Retirer du panier
                </a>
            </p>
        <?php
        }
        ?>

        <form method="get">
            <label for="dateLivraison">Dans combien de jours, voulez-vous être livré ? </label>
            <input type="number" min="1" max="" value="1" name=dateLivraison><br>
            <input style="display: none" type="text" name="uc" value="jeuCasino">
            <input style="display: none" type="text" name="action" value="jeuCasino">
            <br>
            <?php if (isset($client)) { ?>
                <button class="btnCommande" onclick="return confirm('Confirmez-vous votre commande ?');">Passer commande</button>
            <?php
            } else {  ?>
                <p style="color:red";>Vous devez être connecté pour pouvoir commander.</p><br>
            <?php } ?>



        </form><br>
        <p><strong>Informations : </strong></p>
        <p>Nous livrons que les villes aux alentours de Lourmarin</p>
        <p>Les frais de livraison sont de 2,99 euros pour chaque commande inférieure à 50 euros. Au-delà de ce montant, les livraisons sont gratuites. </p>
    </div>



</main>