<?php
class Consegna
{
    public $Codice;
    public $Volontario;
    public $CodicePrestito;
    public $DataConsegna;
    public $TipoConsegna;
    public $Note;
}

class ConsegnaController
{

    /**
     * LIST
     */
    public function list()
    {
        $query = "SELECT * FROM Consegna";
        $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);

        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listNonConsegnate(){
        $query = "SELECT * FROM Consegna where volontario is null";
        $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);

        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listConsInCaricoVolo($volon){
        $query = "SELECT * FROM Consegna where volontario = '$volon' and DataConsegna is null";
        $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);

        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * CREATE
     */
    public function createConsegna($CodicePrestito, $TipoConsegna)
    {
        $query = "INSERT INTO CONSEGNA(CodicePrestito, TipoConsegna) VALUES($CodicePrestito,'$TipoConsegna')";
        $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);

        $stmt->execute();
        echo $query;
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * RETRIEVE
     */
    public function getByPrestito($codPrestito)
    {
        $query = "SELECT * FROM Consegna where Codice = $codPrestito";
        $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * UPDATE
     */
    public function updateVolontario($volon, $codConsegna){
        $query = "UPDATE CONSEGNA SET Volontario = '$volon' WHERE Volontario is null and Codice = $codConsegna";
        $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function updateDisdire($volon, $codConsegna){
        $query = "UPDATE CONSEGNA SET Volontario = null WHERE Volontario = '$volon' and Codice = $codConsegna";
        $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

}
