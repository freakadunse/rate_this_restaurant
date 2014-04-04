<?php
class Lokal {
    private $table = "tbl_lokal";
    
    /**
     * Gibt alle Einträge der Tabelle Lokale zurück.
     * @param String $string Suchbegriff.
     * @return Array Array von Lokalen.
     */
    public function getLokale($string = ""){
        
        if ($string != ""):
            $query = "SELECT * FROM tbl_lokal p WHERE name LIKE '%". $string . "%' OR anschrift LIKE '%" . $string ."%'";
        else:
            $query = "SELECT * FROM tbl_lokal";
        endif;
        
        $result = mysql_query($query);
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
        $fields = $this->sqlEscape($_REQUEST);
        
        $query = "INSERT INTO {$this->table} (name, anschrift, email, passwort, beschreibung) VALUES ('{$fields['name']}','{$fields['anschrift']}','{$fields['emailadresse']}','{$fields['passwort']}','{$fields['beschreibung']}')";
        
        return mysql_query($query);
    }
    
    public function resetPasswort(){
        
    }
    
    public function emailExists($email){
        $return = false;
        $query = "SELECT * FROM tbl_lokal p WHERE email = '". $email . "'";
        
        $result = mysql_query($query);
        
        if(mysql_num_rows($result) > 0) {
            $return = true;
        }
        
        return $return;
    }
    
    private function sqlEscape($request){
        $data = array();
        foreach($request as $key => $value) {
            if($key == 'passwort')
                $data[$key] = md5(mysql_real_escape_string($value));
            else
                $data[$key] = mysql_real_escape_string($value);
        }
        
        return $data;
    }
}