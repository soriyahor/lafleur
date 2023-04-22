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
                $categorie = $unArticle['categorie_id1']
            ?>
                <form method="get">
                    <div>
                        <img src="./public/photo/<?= $photo ?>" alt="Image d'article fleuriste" class="imgVteFleur">
                        <div>
                            <p><?= $nom ?></p>
                            <p><?= $prix . " €" ?></p>
                            <label for="quantite">Quantité</label>
                            <input style="display: none" type="text" name="uc" value="accueil">
                            <input style="display: none" type="text" name="categorie" value="<?= $categorie ?>">
                            <input style="display: none" type="text" name="article" value="<?= $idArticle ?>">
                            <input style="display: none" type="text" name="action" value="ajouterAuPanier">
                            <input type="number" min="0" max="" name=quantite class="inputQuantite">
                            <button class="ajouterPanier">Ajouter au panier</button>
                        </div>

                    </div>
                </form>
            <?php
            }
            ?>
        </div>
    </div>


</main>