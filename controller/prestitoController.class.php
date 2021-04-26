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

    public function createPrestitoConsegna($Utilizzatore, $codLibro)
    {
        $query = "INSERT INTO Prestito(Utilizzatore, Libro) VALUES ('$Utilizzatore',$codLibro)";
        $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);
        echo $query;
        return $stmt->execute();
    }

    /**
     * RETRIEVE
     */
    public function getLikePrestito($Utilizzatore, $Libro)
    {
        $query = "SELECT * FROM Prestito where LOWER(Utilizzatore) LIKE CONCAT" . "('%',LOWER('$Utilizzatore'),'%')" . "and Libro = $Libro ";
        $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLikePrestitoUtente($Utilizzatore)
    {
        $query = "SELECT * FROM Prestito where Utilizzatore = '$Utilizzatore' ";
        $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($codPrestito){
        $query = "SELECT * FROM Prestito where Codice = $codPrestito ";
        $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);

        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
