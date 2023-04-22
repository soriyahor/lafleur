<main>

<h1 class="compte">Mon compte</h1>

<div class="compte">
<div class="cadreCompte">
    <div class="titreCompte">J'ai déjà un compte</div>
    <form action="index.php?uc=inscrire&action=connexion" method="POST">
    <div class="connexion">
        <label for="mail">Adresse e-mail</label><br>
        <input type="text" name="mail"><br>
        <label for="mdp">Mot de passe</label><br>
        <input type="password" name="mdp"><br><br>
        <input type="submit" value="M'identifier" class="boutonCompte">
        </form>
    </div>
</div>

<div class="cadreCompte">
    <div class="titreCompte">Je crée un compte</div>
    <form method="POST" action="index.php?uc=inscrire&action=inscription">
    <div class="inscription">
        <label for="nom">Nom*</label><br>
        <input id="nom" type="text" name="nom" size="30" maxlength="45"><br>
        <label for="prenom">Prénom*</label>
        <input id="prenom" type="text" name="prenom" size="30" maxlength="45"><br>
        <label for="numRue"> numéro de rue</label>
        <input id="numRue" type="text" name="numRue" size="30" maxlength="45"><br>
        <label for="rue">rue*</label><br>
        <input id="rue" type="text" name="rue" size="30" maxlength="45"><br>
        <label for="cp">code postal* </label><br>
        <input id="cp" type="text" name="cp" size="10" maxlength="10"><br>
        <label for="ville">ville* </label><br>
        <input id="ville" type="text" name="ville"  size="30" maxlength="45"><br>
        <label for="mail">Adresse e-mail</label><br>
        <input type="text" name="mail" size ="25" maxlength="25"><br>
        <label for="mdp">Mot de passe</label><br>
        <input type="password" name="mdp" size ="25" maxlength="25"><br>
        <label for="confirmMdp">Confirmer mot de passe</label><br>
        <input type="password" name="confirmMdp" size ="25" maxlength="25"><br><br>
        <input type="submit" value="M'inscrire" class="boutonCompte">
    </div>
    </form>
</div>
</div>


</main>