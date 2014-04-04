<?php
class Controller{  
  
    private $request = null;  
    private $template = '';  
    private $view = null; 
    public $errorMessage = ""; 
    public $successMessage = "";
  
    /** 
     * Konstruktor, erstellt den Controller. 
     * 
     * @param Array $request Array aus $_GET & $_POST. 
     */  
    public function __construct($request){  
       
        $this->view = new View();  
        $this->request = $request;

        if(isset($this->request['view']) && !empty($request['view'])):
            $this->template = strtolower($this->request['view']);
        else:
            $this->template = 'default';  
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
        
        echo $this->display();
    }
    
    public function register(){
        $Lokal = new Lokal();
        
        if(!$Lokal->emailExists($_REQUEST['emailadresse'])):
            if($Lokal->register()):
                $this->successMessage = "Datensatz erfolgreich angelegt, bitte logge Dich jetzt ein.";
                unset($_REQUEST);
            else:
                $this->errorMessage = "Beim Speichern des Datensatzes ist ein Fehler aufgetreten!";
            endif;
        else:
            $this->errorMessage = "Die eingebene Email-Adresse existiert bereits!";
            $Lokal->resetPasswort();
        endif;
        
    }
    
    public function login(){
        echo "Login TEst";
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
        $innerView->assign('errors', $this->errorMessage);
        $innerView->assign('success', $this->successMessage);

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
                
                if(!empty($_SESSION['loggedin'])):
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