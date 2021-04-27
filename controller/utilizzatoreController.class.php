<?php
    /**
     * creo la classe utilizzatore
     * con nome degli attributi uguali ad att tab su mysql
     * 
     */

     class UtilizzatoreController{

        /**
         * LIST
         */
        public function list(){
            $query = "SELECT * FROM Utilizzatore";

            $stmt = Dbh::getInstance()//
                ->getDb()
                ->prepare($query);
            $stmt-> execute();
    
            return $stmt -> fetchAll(PDO::FETCH_ASSOC); //ritorna tutte le righe
        }


        public function checkEsistenza($email, $password){
            //TRUE se utente esiste altrimenti FALSE
            $query ="SELECT * FROM Utilizzatore WHERE email ='$email' AND password ='$password'";
            
            $stmt = Dbh::getInstance()//entro in classe dbh.php che è statico (due puntini)
            ->getDb() //creazione oggetto dbh
            ->prepare($query);
            $stmt-> execute();//esecuzione
            
            return $stmt -> fetchAll(PDO::FETCH_ASSOC); //organizzazione righe in array associativo
            
        }

        //controllo esistenza dell'utente(per amministratore)
        public function checkEsistenza_Admin($utilizzatore){
        $query= "SELECT * from utilizzatore WHERE LOWER(Email) LIKE CONCAT"."('%',LOWER('$utilizzatore'),'%') or  LOWER(nome) LIKE CONCAT"."('%',LOWER('$utilizzatore'),'%') or LOWER(cognome) LIKE CONCAT"."('%',LOWER('$utilizzatore'),'%')";

        $stmt = Dbh::getInstance()
        ->getDb() 
        ->prepare($query);
        $stmt-> execute();
        return $stmt -> fetchAll(PDO::FETCH_ASSOC);   

        }

        public function checkIscrizione($email){
            //TRUE se utente non esiste altrimenti FALSE
            $query = "SELECT * FROM Utilizzatore WHERE email ='$email'";

            $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);
            $stmt->execute();
            return $stmt ->fetchAll(PDO::FETCH_ASSOC);            
        }

            
        public function setStatoAttivo($Utilizzatore){
            $query = "UPDATE Utilizzatore SET Stato='Attivo' WHERE Email = '$Utilizzatore'";

            $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);
            $stmt->execute();
            return $stmt ->fetchAll(PDO::FETCH_ASSOC);  


        }

        
     }

     //

?>