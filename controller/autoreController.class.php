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


}