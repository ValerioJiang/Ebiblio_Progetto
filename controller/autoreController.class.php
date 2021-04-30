<?php
class Autore
{
    public $Nome;
    public $Cognome;
    public $Codice;
}

class AutoreController{
    /**
     * LIST
     */
    public function list()
    {
    }

    public function getLikeAutore($Codice){
        $query = "SELECT Nome,Cognome from autore where codice in(
            select autore from autore_libro where libro = $Codice";

        $stmt = Dbh::getInstance()
        -> getDb()
        -> prepare($query);

        $stmt -> execute();
        return $stmt -> fetchAll(PDO::FETCH_ASSOC);
    }  

    /**
     * CREATE
     */
    public function createAutore($Nome, $Cognome){
        $query = "INSERT INTO Autore(Nome, Cognome) VALUES('$Nome','$Cognome')";

        $stmt = Dbh::getInstance()
        -> getDb()
        -> prepare($query);

        $stmt -> execute();
        echo $query;
        return $stmt -> fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * RETRIEVE
     */
    public function getAutCod($nome, $cognome){
        $query = "SELECT * FROM Autore WHERE LOWER(Nome) LIKE CONCAT"."('%',LOWER('$nome'),'%')"." AND LOWER(Cognome) LIKE CONCAT('%',LOWER('$cognome'),'%')";
            $stmt = Dbh::getInstance()
                ->getDb()
                ->prepare($query);
            $stmt-> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
    }

       //controllo esistenza autore(cartaceo)
          public function getLikeAutoreCartaceo($Nome,$Cognome){
            $query = "SELECT * FROM AUTORE where LOWER(Cognome) LIKE CONCAT"."('%',LOWER('$Cognome'),'%')"."and LOWER(Nome) LIKE CONCAT"."('%',LOWER('$Nome'),'%')";
            $stmt = Dbh::getInstance()
            -> getDb()
            -> prepare($query);
    
            $stmt -> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
            }


}