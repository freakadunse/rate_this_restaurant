<?php
/**
 * Klasse für den Datenzugriff
 */
class Model{

    //Einträge eines Blogs als zweidimensionales Array
    private static $entries = array(
            array("id" => 0, "title"=>"Eintrag 1", "content"=>"Ich bin der erste Eintrag."),
            array("id" => 1, "title"=>"Eintrag 2", "content"=>"Ich bin der ewige Zweite!"),
            array("id" => 2, "title"=>"Eintrag 3", "content"=>"Na dann bin ich die Nummer drei.")
    );

    /**
     * Gibt alle Einträge des Blogs zurück.
     *
     * @return Array Array von Blogeinträgen.
     */
    public static function getEntries(){
        $abfrage = "SELECT * FROM tbl_lokal";
        $result = mysql_query($abfrage);
        $data = array();
        
        while ($row = mysql_fetch_object($result))
            $data[] = $row;
  
        return $data;

    }

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
    
    public static function getEntrySearch($string) {
        $abfrage = "SELECT * FROM tbl_lokal p WHERE name LIKE '%". $string . "%' OR anschrift LIKE '%" . $string ."%'";

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