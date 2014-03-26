<?php
class Controller{  
  
    private $request = null;  
    private $template = '';  
    private $view = null;  
  
    /** 
     * Konstruktor, erstellt den Controller. 
     * 
     * @param Array $request Array aus $_GET & $_POST. 
     */  
    public function __construct($request){  
        $this->view = new View();  
        $this->request = $request; 
        $this->template = !empty($request['view']) ? $request['view'] : 'default';  
        
        
        
        $db_connection = mysql_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD)
            or die("Keine Verbindung zur Datenbank möglich!");
        
        $db_selected = mysql_select_db(DB_NAME);
    }  
  
    /** 
     * Methode zum anzeigen des Contents. 
     * 
     * @return String Content der Applikation. 
     */  
    public function display(){  
        
        if(isset($this->request['search'])):
            $result = Model::getEntrySearch($this->request['search']);
        
        endif;
        
        $innerView = new View();  
        switch($this->template){  
            case 'entry':  
                $innerView->setTemplate('entry');  
                
                if (!isset($result)):
                    $entryid = $this->request['id'];  
                    $posts = Model::getEntry($entryid);
                    $innerView->assign('posts', $posts);  
                else:
                    $innerView->assign('posts', $result);
                endif;  
                
                break;  
                  
            case 'default':  
            default:
                $innerView->setTemplate('default');  
                if (!isset($result)):
                    $entries = Model::getEntries(); 
                    $innerView->assign('entries', $entries);
                else:
                    $innerView->assign('entries', $result);
                endif;  
        }  
        $this->view->setTemplate('theblog');  
        $this->view->assign('blog_title', 'Rate this!');  
        $this->view->assign('blog_footer', '&copy Attila Tevi, Pascal Sch&uuml;mann, Manuel Schmidt');  
        $this->view->assign('blog_content', $innerView->loadTemplate());  
        return $this->view->loadTemplate();  
    }  
    
}  