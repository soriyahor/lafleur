<main>

    <h1 class="selection">Notre sélection</h1>

    <div>
        <div class="cadreBouquet">

            <h2 class="titreSelection">Bouquets</h2>
            <div class="selectionBouquet">
                <?php
                foreach ($lesArticles as $unArticle) {
                    $nom = $unArticle['nom'];
                    $prix = $unArticle['prix'];
                    $photo = $unArticle['photo'];
                    $categorie = $unArticle['categorie_id1'];

                ?>
                    <div>
                        <img src="./public/photo/<?= $photo ?>" alt="Image d'article fleuriste" class="imgVteFleur" />
                        <div>
                            <p><?= $nom ?></p>
                            <p><?= $prix ?></p>
                            <button class="ajouterPanier">Ajouter au panier</button>
                        </div>

                    </div>

                <?php
                }
                ?>

            </div>


            <div class="cadreBouquet">
                <h2 class="titreSelection">Fleurs</h2>
                <div class="selectionBouquet">
                    <div>
                        <img src="./public/photo/pivoine.jpg" alt="photo bouquet" class="imgVteFleur">
                        <div>
                            <p><?= $nom ?></p>
                            <p><?= $prix ?></p>
                            <button class="ajouterPanier">Ajouter au panier</button>
                        </div>

                    </div>

                </div>
                
            </div>
        </div>
        <button class="voirFleurs">Voir nos fleurs</button>
    </div>

    <?php

    include 'v_quiSommesNous.php';
    ?>
    <iframe class="map2" width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=chemin%20de%20la%20fabrique,%2084160%20Lourmarin+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a href="https://www.maps.ie/distance-area-calculator.html">distance maps</a></iframe>
</main>