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
            $query ="SELECT Email,Password FROM Utilizzatore WHERE email ='$email' AND password ='$password'";
            
            $stmt = Dbh::getInstance()//entro in classe dbh.php che è statico (due puntini)
            ->getDb() //creazione oggetto dbh
            ->prepare($query);
            $stmt-> execute();//esecuzione
            return $stmt -> fetchAll(PDO::FETCH_ASSOC); //organizzazione righe in array associativo
            
        }

        public function checkIscrizione($email){
            //TRUE se utente non esiste altrimenti FALSE
            $query = "SELECT Email FROM Utilizzatore WHERE email ='$email'";

            $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);
            $stmt->execute();
            return $stmt ->fetchAll(PDO::FETCH_ASSOC);            
        }
     }

?>