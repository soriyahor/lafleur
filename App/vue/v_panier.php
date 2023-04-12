<main>
    <h1 class="Panier">Panier</h1>

    <?php
    foreach ($lesArticlesDuPanier as $unArticle) {
        $idArticle = $unArticle['id'];
        $nom = $unArticle['nom'];
        $photo = $unArticle['photo'];
        $prix = $unArticle['prix'];
        $quantite = $unArticle['quantite'];
        ?>
        <p>
        <img src="./public/photo/<?= $photo ?>" alt="Image d'article fleuriste" class="imgVteFleur" width="70" height="70">
            <?php
            echo $nom . "($prix Euros)";
            echo $quantite . " (quantite)";
            
            ?>	
            <a href="index.php?uc=panier&article=<?php echo $idArticle ?>&action=supprimerUnArticle" onclick="return confirm('Voulez-vous vraiment retirer cet article ?');">
                <img src="public/images/retirerpanier.png" TITLE="Retirer du panier" >
            </a>
        </p>
        <?php
    }
    ?>
    <br>
    <a href=index.php?uc=commander&action=passerCommande>
        <img src="public/images/commander.jpg" title="Passer commande" >
    </a>



</main>