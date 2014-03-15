<?php
class Controller{  
  
    private $request = null;  
    private $template = '';  
    private $view = null;  
  
    /** 
     * Konstruktor, erstellet den Controller. 
     * 
     * @param Array $request Array aus $_GET & $_POST. 
     */  
    public function __construct($request){  
        $this->view = new View();  
        $this->request = $request; 
        $this->template = !empty($request['view']) ? $request['view'] : 'default';  
    }  
  
    /** 
     * Methode zum anzeigen des Contents. 
     * 
     * @return String Content der Applikation. 
     */  
    public function display(){  
        $innerView = new View();  
        switch($this->template){  
            case 'entry':  
                $innerView->setTemplate('entry');  
                $entryid = $this->request['id'];  
                $entry = Model::getEntry($entryid);  
                $innerView->assign('title', $entry['title']);  
                $innerView->assign('content', $entry['content']);  
                break;  
                  
            case 'default':  
            default:  
                $entries = Model::getEntries();  
                $innerView->setTemplate('default');  
                $innerView->assign('entries', $entries);  
        }  
        $this->view->setTemplate('theblog');  
        $this->view->assign('blog_title', 'Der Titel des Blogs');  
        $this->view->assign('blog_footer', 'Ein Blog von und mit MVC');  
        $this->view->assign('blog_content', $innerView->loadTemplate());  
        return $this->view->loadTemplate();  
    }  
}  