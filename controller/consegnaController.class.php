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
}
