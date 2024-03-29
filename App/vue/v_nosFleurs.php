<main>
    <h1 class="titreFleurs">Nos fleurs</h1>
    <div class="ensFiltre">
        <?php
        foreach ($lesCategories as $uneCategorie) {
            $idCategorie = $uneCategorie['id'];
            $nomCategorie = $uneCategorie['nom'];
        ?>
            <a href=index.php?uc=nosFleurs&categorie=<?php echo $idCategorie ?>&action=voirParCategorie><button class="filtre"><?= $nomCategorie ?></button></a>
        <?php
        }
        ?>

        <a href=index.php?uc=nosFleurs&conditionnement=lesbouquets&action=voirLesBouquets><button class="filtre">Bouquets</button></a><br>

    </div>

    <div class="selectCouleurs">
        <form action="" method="get">
            <input type="text" name="uc" value="nosFleurs" class="cache">
            <input type="text" name="action" value="voirParCouleur" class="cache">
            <label for="couleurs" name="couleurs">Couleurs :</label>
            <?php
            foreach ($lesCouleurs as $uneCouleur) {
                $idCouleur = $uneCouleur['id'];
                $nomCouleur = $uneCouleur['nom'];
            ?>
                <input type="checkbox" name="couleur" id="color <?= $idCouleur ?>" value="<?= $nomCouleur ?>"> <label for="couleurs"><?= $nomCouleur ?></label>

            <?php
            }
            ?>

            <input type="submit" value="Valider"><br>
        </form>
    </div>

    <div class="containerGrid1">
        <div class="containGrid2">
            <?php
            foreach ($lesArticles as $unArticle) {
                $idArticle = $unArticle['id'];
                $nom = $unArticle['nom'];
                $prix = $unArticle['prix'];
                $photo = $unArticle['photo'];
                $categorie = $unArticle['categorie_id1'];
                $quantite_stock = $unArticle['quantite_stock'];
                $conditionnement = $unArticle['typeConditionnement'];
            ?>
                <form method="get">
                    <div>
                        <img src="./public/photo/<?= $photo ?>" alt="Image d'article fleuriste" class="imgVteFleur">
                        <div>
                            <p><?= $nom ?></p>
                            <p><?= $prix . " €" ?></p>
                            <p><?= $conditionnement ?></p>
                            <?php
                            if ($quantite_stock > 0) { ?>
                                <input style="display: none" type="text" name="uc" value="accueil">
                                <input style="display: none" type="text" name="categorie" value="<?= $categorie ?>">
                                <input style="display: none" type="text" name="article" value="<?= $idArticle ?>">
                                <input style="display: none" type="text" name="action" value="ajouterAuPanier">
                                <label>Quantité</label>
                                <input type="number" min="0" name=quantite class="inputQuantite" value="1"><br>
                                <button class="ajouterPanier">Ajouter au panier</button>
                            <?php
                            } else {
                            ?>
                                <br>
                                <div class="rupture">En rupture de stock</div>
                            <?php
                            }
                            ?>
                        </div>

                    </div>
                </form>
            <?php
            }
            ?>
        </div>
    </div>


</main>