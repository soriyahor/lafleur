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

        $reqVille = "insert into ville(nom) values ('$ville')";
        $resVille = AccesDonnees::exec($reqVille);
        $idVille = AccesDonnees::getPdo()->lastInsertId();

        $reqAdresse = "insert into adresse(numero, rue, cp, id_ville) values ('$numRue', '$rue', '$cp', '$idVille')";
        $resAdresse = AccesDonnees::exec($reqAdresse);
        $idAdresse = AccesDonnees::getPdo()->lastInsertId();

        $mdp = password_hash($mdp, PASSWORD_BCRYPT);
        $reqClient = "insert into clients(nom, prenom, email, mdp, id_adresse) values ('$nom','$prenom', '$mail', '$mdp', '$idAdresse')";
        $resClient = AccesDonnees::exec($reqClient);
        $idClient = AccesDonnees::getPdo()->lastInsertId();
    }

    public static function recupererUtilisateur($mail) {
        $sql = 'SELECT * FROM clients ';
        $sql .= 'WHERE email = :mail';

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
        $sql = 'SELECT 1 FROM clients ';
        $sql .= 'WHERE email = :mail';

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
        if ($numRue == "") {
            $erreurs[] = "Il faut saisir le champ numéro rue";
        }
        if ($rue == "") {
            $erreurs[] = "Il faut saisir le champ rue";
        }
        if ($ville == "") {
            $erreurs[] = "Il faut saisir le champ ville";
        }
        if ($cp == "") {
            $erreurs[] = "Il faut saisir le champ Code postal";
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
        } else if (!estUnMail($mail)) {
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
        $sql = 'SELECT 1 FROM clients ';
        $sql .= 'WHERE email = :mail AND mdp = :mdp';

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

        $sql = "SELECT email, mdp FROM clients WHERE email = :mail";
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":mail", $mail, PDO::PARAM_STR);

        $stmt->execute();

        $data = $stmt->fetch();
        $mdp_bdd = $data['mdp'];
        
        return password_verify($mdp, $mdp_bdd);
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
