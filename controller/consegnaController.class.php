<?php
require 'vendor/autoload.php';
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
        $query = "SELECT * FROM Consegna where volontario = '$volon' and dataconsegna is null";
        $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);

        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * CREATE
     */
    public function createConsegna($CodicePrestito,$TipoConsegna)
    {
        $query = "INSERT INTO CONSEGNA(CodicePrestito, TipoConsegna) VALUES($CodicePrestito,'$TipoConsegna')";
        $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createConsegnaRestituzione($CodicePrestito,$TipoConsegna, $DataConsegna)
    {
        $query = "INSERT INTO CONSEGNA(CodicePrestito, TipoConsegna, DataConsegna) VALUES($CodicePrestito,'$TipoConsegna','$DataConsegna')";
        $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);
        echo $query;
        $stmt->execute();
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

    public function getClassificaConsegna(){
        $query = "SELECT nome, cognome, count(volontario)as 'Tot.Consegne'  from volontario join consegna on volontario = email
        group by volontario order by count(volontario) desc";
        $stmt = Dbh::getInstance()
        ->getDb()
        ->prepare($query);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listConsEffetuate($volon){
        $query = "SELECT * FROM Consegna WHERE Volontario = '$volon' AND DataConsegna is not null";
        $stmt = Dbh::getInstance()
        ->getDb()
        ->prepare($query);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function consegnaUtil($util){
        $query = "select * from consegna where CodicePrestito in (select codice from prestito where Utilizzatore ='$util')";
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
        $query = "UPDATE CONSEGNA SET Volontario = NULL WHERE Volontario = '$volon' and Codice = $codConsegna";
        $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function updateConsegnaEffettiva($volon, $codConsegna, $dataConsegna, $note){
        $query = "UPDATE CONSEGNA SET DataConsegna = '$dataConsegna', Note = '$note' WHERE Volontario = '$volon' and Codice = $codConsegna";
        
        $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    
    public function deleteConsegna($CodicePrestito){
        $query = "DELETE from consegna where codicePrestito = $CodicePrestito";
        $stmt = Dbh::getInstance()
        ->getDb()
        ->prepare($query);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    }



}
