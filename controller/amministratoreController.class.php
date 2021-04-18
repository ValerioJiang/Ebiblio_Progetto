<?php
    class Amministratore{
        public $Email; 
        public $Password; 
        public $Nome; 
        public $Cognome; 
        public $DataNascita; 
        public $LuogoNascita; 
        public $Tel;
        public $Qualifica; 
        public $BibliotecaGestita;
    }

    class AmministratoreController{
        /**
         * LIST
         */
        public function list(){
            $query="SELECT * FROM Amministratore";
            $stmt = $stmt = Dbh::getInstance()//
                ->getDb()
                ->prepare($query);
            $stmt-> execute();

            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }

        /**
         * RETRIEVE
         */
        public function getLikeAmministratore($emailAmminis){
            $query = "SELECT * FROM Amministratore WHERE LOWER(Email) LIKE CONCAT"."('%',LOWER('$$emailAmminis'),'%')";
            $stmt = Dbh::getInstance()
                ->getDb()
                ->prepare($query);
            $stmt-> execute();
    
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);

        }

        public function checkEsistenza($email, $password){
            //TRUE se utente esiste altrimenti FALSE
            $query ="SELECT * FROM Amministratore WHERE email ='$email' AND password ='$password'";
            
            $stmt = Dbh::getInstance()//entro in classe dbh.php che è statico (due puntini)
            ->getDb() //creazione oggetto dbh
            ->prepare($query);
            $stmt-> execute();//esecuzione
            echo $query;
            return $stmt -> fetchAll(PDO::FETCH_ASSOC); //organizzazione righe in array associativo
            
        }

        public function checkIscrizione($email){
            //TRUE se utente non esiste altrimenti FALSE
            $query = "SELECT * FROM Amministratore WHERE email ='$email'";

            $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);
            $stmt->execute();
            return $stmt ->fetchAll(PDO::FETCH_ASSOC);            
        }
    }

?>