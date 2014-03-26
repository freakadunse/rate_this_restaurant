<?php
class Einrichtung {
    
    /**
     * Gibt alle Einträge der Tabelle Einrichtungen zurück.
     * @param String $string Suchbegriff.
     * @return Array Array von Einrichtungen.
     */
    public static function getEinrichtungen($string = ""){
        
        if ($string != ""):
            $abfrage = "SELECT * FROM tbl_einrichtung p WHERE name LIKE '%". $string . "%' OR anschrift LIKE '%" . $string ."%'";
        else:
            $abfrage = "SELECT * FROM tbl_einrichtung";
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
    
    
}