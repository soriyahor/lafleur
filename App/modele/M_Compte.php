<?php


class M_Compte
{

    /**
     * Connecte à un compte
     *
     * @param $nom
     * @param $prenom
     * @param $rue
     * @param $cp
     * @param $ville
     * @param $mail
     * @param $mdp
     *

     */

    public static function CreerInscription($nom, $prenom, $numRue, $rue, $cp, $ville, $mail, $mdp)
    {

        //chercher dans bdd les ids la ville par le nom et le codepostal

        $reqVilleExistant = "SELECT * FROM ville WHERE nom =:nomVille";
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare($reqVilleExistant);
        $stmt->bindParam(":nomVille", $ville, PDO::PARAM_STR);
        $stmt->execute();
        // Exécution
        $resVilleExistant = $stmt->fetch();

        $reqCpExistant = "SELECT * FROM codePostal WHERE cp=:cp";
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare($reqCpExistant);
        $stmt->bindParam(":cp", $cp, PDO::PARAM_INT);
        $stmt->execute();
        // Exécution
        $resCpExistant = $stmt->fetch();

        if(isset($resVilleExistant['id'])){

            $idVille = $resVilleExistant['id'];
        } else {
            $reqVille = "insert into ville(nom) values ('$ville')";
            $resVille = AccesDonnees::exec($reqVille);
            $idVille = AccesDonnees::getPdo()->lastInsertId();
    
        }

        if(isset($resCpExistant['id'])){
            $idCp = $resCpExistant['id'];
        } else {
            $reqCp = "insert into codePostal(cp) values ('$cp')";
        $resCp = AccesDonnees::exec($reqCp);
        $idCp = AccesDonnees::getPdo()->lastInsertId();
        }
        

        $reqAdresse = "insert into adresse(numero, rue, codePostal_id, ville_id) values ('$numRue', '$rue', '$idCp', '$idVille')";
        $resAdresse = AccesDonnees::exec($reqAdresse);
        $idAdresse = AccesDonnees::getPdo()->lastInsertId();

        $mdp = password_hash($mdp, PASSWORD_BCRYPT);
        $reqClient = "insert into client(nom, prenom, mail, mdp) values ('$nom','$prenom', '$mail', '$mdp')";
        $resClient = AccesDonnees::exec($reqClient);
        $idClient = AccesDonnees::getPdo()->lastInsertId();

        $reqClient = "insert into adresse_client(client_id, adresse_id) values ('$idClient', '$idAdresse')";
        $resClient = AccesDonnees::exec($reqClient);
        $idClient = AccesDonnees::getPdo()->lastInsertId();
    }

    public static function recupererUtilisateur($mail) {
        $sql = 'SELECT * FROM client ';
        $sql .= 'WHERE mail = :mail';

        // prepare and bind
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":mail", $mail, PDO::PARAM_STR);
        $stmt->execute();
        // Exécution
        $res = $stmt->fetch();
        return $res;

    }

    /**
     * Fonction qui vérifie que l'identification saisie est correcte.
     */
    public static function utilisateur_existe($mail)
    {
        $sql = 'SELECT 1 FROM client ';
        $sql .= 'WHERE mail = :mail';

        // prepare and bind
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":mail", $mail);


        // Exécution
        $stmt->execute();

        // L'identification est bonne si la requête a retourné
        // une ligne (l'utilisateur existe et le mot de passe
        // est bon).
        // Si c'est le cas $existe contient 1, sinon elle est
        // vide. Il suffit de la retourner en tant que booléen.
        if ($stmt->rowCount() > 0) {
            // ok, il existe
            $existe = true;
        } else {
            $existe = false;
        }
        return (bool) $existe;
    }



    /**
     * Retourne vrai si pas d'erreur
     * Remplie le tableau d'erreur s'il y a
     *
     * @param $nom : chaîne
     * @param $rue : chaîne
     * @param $ville : chaîne
     * @param $cp : chaîne
     * @param $mail : chaîne
     * @param $mail : chaîne
     * @param $mdp : chaîne
     * @return : array
     */
    public static function estValide($nom, $prenom, $numRue, $rue, $ville, $cp, $mail, $mdp)
    {
        $erreurs = [];
        if ($nom == "") {
            $erreurs[] = "Il faut saisir le champ nom";
        }
        if ($prenom == "") {
            $erreurs[] = "Il faut saisir le champ prenom";
        }
        if ($rue == "") {
            $erreurs[] = "Il faut saisir le champ rue";
        }
        if ($ville == "") {
            $erreurs[] = "Il faut saisir le champ ville";
        }
        if ($cp == "") {
            $erreurs[] = "Il faut saisir le champ Code postal !";
        } else if (!estUnCp($cp)) {
            $erreurs[] = "erreur de code postal";
        }
        if ($mail == "") {
            $erreurs[] = "Il faut saisir le champ mail";
        }
        if (M_Compte::utilisateur_existe($mail)) {
            $erreurs[] = "vous avez deja un compte";
        }
        if ($mdp == "") {
            $erreurs[] = "Il faut saisir un mot de passe";
        }
        if (!estUnMdp($mdp)) {
            $erreurs[] = "erreur de mdp : le mot de passe doit avoir au moins 8 caractères, avec au moins une lettre majuscule, une lettre minuscule, un chiffre";
        }
        if (!estUnMail($mail)) {
            $erreurs[] = "erreur de mail";
        }
        return $erreurs;
    }
}

class M_Session
{

    /**
     * Fonction qui vérifie que l'identification saisie est correcte.
     */
    function compte_existe($mail, $mdp)
    {
        $sql = 'SELECT 1 FROM client ';
        $sql .= 'WHERE mail = :mail AND mdp = :mdp';

        // prepare and bind
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":mail", $mail, PDO::PARAM_STR);
        $stmt->bindParam(":mdp", $mdp, PDO::PARAM_STR);

        // Exécution
        $stmt->execute();

        // L'identification est bonne si la requête a retourné
        // une ligne (l'utilisateur existe et le mot de passe
        // est bon).
        // Si c'est le cas $existe contient 1, sinon elle est
        // vide. Il suffit de la retourner en tant que booléen.
        if ($stmt->rowCount() > 0) {
            // ok, il existe
            $existe = true;
        } else {
            $existe = false;
        }
        return (bool) $existe;
    }

    /**
     * verifie le mail ou mdp
     *
     * @param String $mail
     * @param String $mdp
     * @return void
     */
    public static function checkPassword(String $mail, String $mdp)
    {

        $sql = "SELECT mail, mdp FROM client WHERE mail = :mail";
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":mail", $mail, PDO::PARAM_STR);

        $stmt->execute();

        $data = $stmt->fetch();
        if(!isset($data['mdp'])){
            return false;
        }
                
        return password_verify($mdp, $data['mdp']);
    }

    
    public static function connexionValide($mail, $mdp)
    {
        $erreurs = [];
        if ($mail == "") {
            $erreurs[] = "Il faut saisir le champ email";
        }
        if ($mdp == "") {
            $erreurs[] = "Il faut saisir le champ mot de passe";
        }
        if(M_Session::checkPassword($mail, $mdp) == false){
            $erreurs[] = "email ou mot de passe incorrect";
        }
        return $erreurs;
    }

    public static function deconnexion(){
        unset($_SESSION['client']);       
        header('location: index.php');
        die;
    }
}
