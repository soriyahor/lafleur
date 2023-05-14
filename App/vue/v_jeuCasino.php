<main>
    <h1 class="titreFleurs">Roulette fête des mères</h1>
    <div class="ensFiltre">

    <div style="display: none;" id="loteries"><?php $loteries ?></div>

        <div class="jeu">
            <h1>Gagner à notre jeu spécial fête des mères</h1>
            <div class="containerRoulette">
                <div class="jeuRoulette">
                    <div id="roulette1" class="roulette"></div>
                    <div id="roulette2" class="roulette"></div>
                    <div id="roulette3" class="roulette"></div>
                    <div class="reset"></div>
                </div>
                <div id="resultat"></div>
                <div><button id="start">Jouer !</button></div>
            </div>
        </div>

       <form method="get" style="display: none;">
            <input type="number" min="1" max="100" value="<?php echo $dateLivraison ?>" name=dateLivraison>
            <input type="number" min="-1" max="" value="-1" name=idLoterie>
            <input style="display: none" type="text" name="uc" value="commander">
            <input style="display: none" type="text" name="action" value="passerCommande">
            <button class="ajouterPanier" id="ajouterPanier">Ajouter au panier</button>
        </form>

    </div>
</main>