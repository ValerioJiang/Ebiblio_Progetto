<?php
class Prestito
{
    public $Codice;
    public $Utilizzatore;
    public $Libro;
    public $Biblioteca;
    public $DataInizio;
    public $DataFine;
}

class PrestitoController
{
    /**
     * CREATE
     */
    public function createPrestito($Utilizzatore, $codLibro, $dataInizio)
    {
        $dataFine = date("Y-m-d", strtotime("{$dataInizio}+15 days"));
        $query = "INSERT INTO Prestito(Utilizzatore, Libro, DataInizio, DataFine) VALUES ('$Utilizzatore',$codLibro, '$dataInizio','$dataFine')";

        $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);
        
        
        return $stmt->execute();
    }

    public function createPrestitoConsegna($Utilizzatore, $codLibro, $nomeBiblio)
    {

        $query = "INSERT INTO Prestito(Utilizzatore, Libro, Biblioteca) VALUES ('$Utilizzatore',$codLibro, '$nomeBiblio')";

        $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);
        return $stmt->execute();
    }

    /**
     * RETRIEVE
     */
    public function getLikePrestito($Utilizzatore, $Libro, $Biblioteca)
    {
        $query = "SELECT * FROM Prestito where LOWER(Utilizzatore) LIKE CONCAT" . "('%',LOWER('$Utilizzatore'),'%')" ." AND LOWER(Biblioteca) LIKE CONCAT" . "('%',LOWER('$Biblioteca'),'%')" . "and Libro = $Libro ";
        $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
