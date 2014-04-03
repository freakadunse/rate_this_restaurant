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
        
        $this->init();
    }  
    
    private function init(){
        // starten der Session
        session_start();
        // schreiben einer ID in die Session
        $_SESSION['id'] = session_id();
        
        if(empty($_SESSION['loggedin']))
            $_SESSION['loggedin'] = false;
        
        if(empty($_SESSION['login_required']))
            $_SESSION['login_required'] = false;

        $this->index();
    }
    
    public function index(){
        
       if(isset($_REQUEST['action'])){
          
           if($_REQUEST['action'] == 'login'){
                 
                 $this->login();
             } elseif ($_REQUEST['action'] == 'register'){
                 $this->register();
             }
        }
    }
    
    public function register(){
        $Lokal = new Lokal();
        
        if(!$Lokal->existEmail($_REQUEST['emailadresse'])):
            $Lokal->register();
        else:
            $Lokal->resetPasswort();
        endif;
    }
  
    /** 
     * Methode zum anzeigen des Contents. 
     * 
     * @return String Content der Applikation. 
     */  
    public function display(){  
        $Lokal = new Lokal();
        if(isset($this->request['search'])):
            $result = $Lokal->getLokale($this->request['search']);
        endif;
        
        $innerView = new View();
        switch($this->template){
            case 'detail':
                $innerView->setTemplate('detail');
        
                if (!isset($result)):
                    $lokal_id = $this->request['id'];
                    $posts = Posts::getEntry($lokal_id);
                    $innerView->assign('posts', $posts);
                else:
                    $innerView->assign('posts', $result);
                endif;
        
                break;
            case 'edit':
                
                if($_SESSION['loggedin']):
                    $innerView->setTemplate('edit');
                else:
                    $innerView->setTemplate('login');
                    $_SESSION['login_required'] = true;
                endif;
            
                
            
                break;
    
            case 'default':
            default:
                $innerView->setTemplate('default');
                if (!isset($result)):
                $lokale = $Lokal->getLokale();
                $innerView->assign('lokale', $lokale);
                else:
                $innerView->assign('lokale', $result);
                endif;
        }
         
        
        $this->view->setTemplate('home');
        $this->view->assign('home_title', 'Rate this!');
        $this->view->assign('home_footer', '&copy Attila Tevi, Pascal Sch&uuml;mann, Manuel Schmidt');
        $this->view->assign('home_content', $innerView->loadTemplate());
        return $this->view->loadTemplate();
        
    }
 
}  