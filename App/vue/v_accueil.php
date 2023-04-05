<main>

    <h1 class="selection">Notre sélection</h1>

    <div>
        <div class="cadreBouquet">

            <h2 class="titreSelection">Bouquets</h2>
            <div class="selectionBouquet">
                <?php
                foreach ($lesBouquets as $unBouquet) {
                    $id = $unBouquet['id'];
                    $nom = $unBouquet['nom'];
                    $prix = $unBouquet['prix'];
                    $photo = $unBouquet['photo'];
                    $categorie = $unBouquet['categorie_id1'];

                ?>
                    <div>
                        <img src="./public/photo/<?= $photo ?>" alt="Image d'article fleuriste" class="imgVteFleur" />
                        <div>
                            <p><?= $nom ?></p>
                            <p><?= $prix . " €" ?></p>
                            <a href="index.php?uc=visite&categorie=<?= $categorie ?>&jeu=<?= $id ?>&action=ajouterAuPanier">
                                <button class="ajouterPanier">Ajouter au panier</button>
                            </a>
                        </div>

                    </div>

                <?php
                }
                ?>

            </div>


            <div class="cadreBouquet">
                <h2 class="titreSelection">Fleurs</h2>
                <div class="selectionBouquet">
                    <?php
                    foreach ($lesFleurs as $uneFleur) {
                        $id = $unBouquet['id'];
                        $nom = $uneFleur['nom'];
                        $prix = $uneFleur['prix'];
                        $photo = $uneFleur['photo'];
                        $categorie = $uneFleur['categorie_id1'];

                    ?>
                        <div>
                            <img src="./public/photo/<?= $photo ?>" alt="Image d'article fleuriste" class="imgVteFleur" />
                            <div>
                                <p><?= $nom ?></p>
                                <p><?= $prix . " €" ?></p>
                                <a href="index.php?uc=visite&categorie=<?= $categorie ?>&jeu=<?= $id ?>&action=ajouterAuPanier">
                                    <button class="ajouterPanier">Ajouter au panier</button>
                                </a>
                            </div>

                        </div>
                    <?php
                    }
                    ?>
                </div>

            </div>

        </div>
        <a href="index.php?uc=nosFleurs&action=voirTousLesArticles">
            <button class="voirFleurs">Voir nos fleurs</button></a>
        </a>
    </div>

    <?php

    include 'v_quiSommesNous.php';
    ?>
    <iframe class="map2" width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=chemin%20de%20la%20fabrique,%2084160%20Lourmarin+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a href="https://www.maps.ie/distance-area-calculator.html">distance maps</a></iframe>
</main>