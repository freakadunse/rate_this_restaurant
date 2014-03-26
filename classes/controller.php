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
        

        if(isset($this->request['new'])):
            $this->template = strtolower($this->request['new']);
        else:
            $this->template = !empty($request['view']) ? $request['view'] : 'default';  
           
        endif;
    }  
  
    /** 
     * Methode zum anzeigen des Contents. 
     * 
     * @return String Content der Applikation. 
     */  
    public function display(){  
        
        if(isset($this->request['search'])):
            $result = Einrichtung::getEinrichtungen($this->request['search']);
        endif;
        
        $innerView = new View();
        switch($this->template){
            case 'detail':
                $innerView->setTemplate('detail');
        
                if (!isset($result)):
                $einrichtung_id = $this->request['id'];
                $posts = Posts::getEntry($einrichtung_id);
                $innerView->assign('posts', $posts);
                else:
                $innerView->assign('posts', $result);
                endif;
        
                break;
            case 'einrichtung':
                $innerView->setTemplate('new_einrichtung');
            
                
            
                break;
    
            case 'default':
            default:
                $innerView->setTemplate('default');
                if (!isset($result)):
                $einrichtungen = Einrichtung::getEinrichtungen();
                $innerView->assign('einrichtungen', $einrichtungen);
                else:
                $innerView->assign('einrichtungen', $result);
                endif;
        }
         
        
        $this->view->setTemplate('home');
        $this->view->assign('home_title', 'Rate this!');
        $this->view->assign('home_footer', '&copy Attila Tevi, Pascal Sch&uuml;mann, Manuel Schmidt');
        $this->view->assign('home_content', $innerView->loadTemplate());
        return $this->view->loadTemplate();
        
    }  
}  