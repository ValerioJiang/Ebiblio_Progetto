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
    
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }

     }

?>