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
        <input type="number" min="1" max="" value ="1" name=dateLivraison>
        <input style="display: none" type="text" name="uc" value="jeuCasino">
        <input style="display: none" type="text" name="action" value="jeuCasino">
        <br>
        <button class="btnCommande" onclick="return confirm('Confirmez-vous votre commande ?');">Passer commande</button>


    </form>

    </div>



</main>