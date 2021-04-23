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
    public function createPrestito($Utilizzatore, $codLibro, $nomeBiblio, $Scaffale, $dataInizio)
    {
        $dataFine = date("Y-m-d", strtotime("{$dataInizio}+15 days"));
        $query = "INSERT INTO Prestito(Utilizzatore, Libro, Biblioteca, Scaffale, DataInizio, DataFine) VALUES ('$Utilizzatore',$codLibro, '$nomeBiblio','$Scaffale','$dataInizio','$dataFine')";

        $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);
            
        return $stmt->execute();
    }

    public function createPrestitoConsegna($Utilizzatore, $codLibro, $nomeBiblio, $Scaffale)
    {

        $query = "INSERT INTO Prestito(Utilizzatore, Libro, Biblioteca, Scaffale) VALUES ('$Utilizzatore',$codLibro, '$nomeBiblio','$Scaffale')";

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
