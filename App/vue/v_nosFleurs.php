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
        <button class="filtre">Bouquets</button><br>
    </div>

    <div class="selectCouleurs">
        <label for="couleurs" name="couleurs">Couleurs :</label>
        <input type="checkbox" name="couleurs" id="colorRed"> <label for="couleurs">Rouge</label>
        <input type="checkbox" name="couleurs" id="colorWhite"> <label for="couleurs">Blanc</label>
        <input type="checkbox" name="couleurs" id="colorYellow"> <label for="couleurs">Jaune</label>
        <input type="checkbox" name="couleurs" id="colorPink"> <label for="couleurs">Rose</label>

        <input type="submit" value="Valider"><br>
    </div>

    <div class="containerGrid1">
        <div class="containGrid2">
            <?php
            foreach ($lesArticles as $unArticle) {
                $nom = $unArticle['nom'];
                $prix = $unArticle['prix'];
                $photo = $unArticle['photo'];
                $categorie = $unArticle['categorie_id1']
            ?>
                <div>
                    <img src="./public/photo/<?= $photo ?>" alt="Image d'article fleuriste" class="imgVteFleur">
                    <div>
                        <p><?= $nom ?></p>
                        <p><?= $prix . " €" ?></p>
                        <button class="ajouterPanier">Ajouter au panier</button>
                    </div>

                </div>

            <?php
            }
            ?>
        </div>
    </div>


</main>