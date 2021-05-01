<?php
require 'vendor/autoload.php';
    class Volontario{
        public $Email;  
        public $Password; 
        public $Nome;
        public $Cognome; 
        public $DataNascita; 
        public $LuogoNascita; 
        public $Tel;
        public $MezzoTrasporto;
    }

    class VolontarioController{
        /**
         * LIST
         */
        public function list(){
            $query="SELECT * FROM VOLONTARIO";
            $stmt = $stmt = Dbh::getInstance()//
                ->getDb()
                ->prepare($query);
            $stmt-> execute();

            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }

        /**
         * RETRIEVE
         */
        public function getLikeVolontario($emailVolo){
            $query = "SELECT * FROM Volontario WHERE LOWER(Email) LIKE CONCAT"."('%',LOWER('$emailVolo'),'%')";
            $stmt = Dbh::getInstance()
                ->getDb()
                ->prepare($query);
            $stmt-> execute();
    
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);

        }

        public function checkEsistenza($email, $password){
            $query ="SELECT * FROM Volontario WHERE email ='$email' AND password ='$password'";
            
            $stmt = Dbh::getInstance()
            ->getDb() 
            ->prepare($query);
            $stmt-> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC); 
        }

        public function checkIscrizione($email){
            //TRUE se utente non esiste altrimenti FALSE
            $query = "SELECT * FROM Volontario WHERE email ='$email'";
            $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);
            $stmt->execute();
            return $stmt ->fetchAll(PDO::FETCH_ASSOC);            
        }
    }

?>