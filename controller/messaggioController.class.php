<?php
    require 'vendor/autoload.php';
    class Messaggio{
        public $Amministratore; 
        public $Utilizzatore; 
        public $DataInvio; 
        public $Titolo; 
        public $Testo; 
    }
    

    /**
     * LIST
    */
    class MessaggioController{
    public function list(){
        $query="SELECT * FROM Messaggio";
        $stmt = $stmt = Dbh::getInstance()//
            ->getDb()
            ->prepare($query);
        $stmt-> execute();

        return $stmt -> fetchAll(PDO::FETCH_ASSOC);
    }

     //INVIO MESSAGGI
        //invio messaggio
        public function createMessaggio($Mittente,$Destinatario,$Titolo,$Messaggio){
            $query = "INSERT into  messaggio value('$Mittente','$Destinatario',now(),'$Titolo','$Messaggio')";

            $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);
            $stmt->execute();
            return $stmt ->fetchAll(PDO::FETCH_ASSOC);        

        }

        //controllo esistenza chat
        public function getMessaggio($Utilizzatore,$Amministratore){
            $query ="SELECT * from Messaggio where Amministratore like '$Amministratore' and lower(utilizzatore) like ('%',LOWER('$Utilizzatore'),'%')";

            $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);
            $stmt->execute();
            return $stmt ->fetchAll(PDO::FETCH_ASSOC);
        }

}