<?php


class M_Loterie
{

    public static function findAll(){
        $req = "SELECT * FROM loterie";
        $pdo=AccesDonnees::getPdo();
        $statement=$pdo->prepare($req);
        $statement->execute();

        $lesLignes = $statement->fetchAll();
        return $lesLignes;
    }

}