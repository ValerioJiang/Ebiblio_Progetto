<?php
class Biblioteca extends Dbh
{
    /**
     * CRUD
     */

    /**
     * LIST
     */
    public function list()
    {
        $result = array();
        $sql = 'SELECT * FROM Biblioteca';
        $stmt = $this->connect()->query($sql);
        while ($row = $stmt->fetch()) {
            foreach ($row as $element) {
                array_push($result, $element);
            }
        }
        return $result;
    }

    /**
     * CREATE
     */
    public function create(){
        
    }
}
?>