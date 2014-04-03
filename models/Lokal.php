<?php
class Lokal {
    
    /**
     * Gibt alle Einträge der Tabelle Lokale zurück.
     * @param String $string Suchbegriff.
     * @return Array Array von Lokalen.
     */
    public function getLokale($string = ""){
        
        if ($string != ""):
            $abfrage = "SELECT * FROM tbl_lokal p WHERE name LIKE '%". $string . "%' OR anschrift LIKE '%" . $string ."%'";
        else:
            $abfrage = "SELECT * FROM tbl_lokal";
        endif;
        
        $result = mysql_query($abfrage);
        $data = array();
    
        while ($row = mysql_fetch_object($result))
            $data[] = $row;
    
        if (count($data) > 0):
            return $data;
        else:
            return null;
        endif;
    }
    
    
    public function register(){
        dump($_REQUEST); 
        // schreibe in Datenbank
        exit;
    }
    
    public function resetPasswort(){
        
    }
    
    public function existEmail($email){
        $return = false;
        $abfrage = "SELECT * FROM tbl_lokal p WHERE email = '". $email . "'";
        
        $result = mysql_query($abfrage);
        
        if(mysql_num_rows($result) > 0) {
            $return = true;
        }
        
        return $return;
    }
}