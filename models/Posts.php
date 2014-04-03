<?php
class Posts {
    
    /**
     * Gibt einen bestimmten Eintrag zurück.
     *
     * @param int $id Id des gesuchten Eintrags
     * @return Array Array, dass einen Eintrag repräsentiert, bzw.
     *                  wenn dieser nicht vorhanden ist, null.
     */
    public static function getEntry($id){
    
        $abfrage = "SELECT * FROM tbl_posts p INNER JOIN tbl_lokal l ON (l.lokal_id = p.lokal_id) WHERE p.lokal_id = ". $id;
        $result = mysql_query($abfrage);
        $data = array();
    
        while ($entry = mysql_fetch_object($result)){
            $data[] = $entry;
        }
    
        if (count($data) > 0):
        return $data;
        else:
        return null;
        endif;
    }
}