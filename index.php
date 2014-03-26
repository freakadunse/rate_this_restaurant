<?php 
// Klassen einbinden
include('classes/controller.php');
include('classes/model.php');
include('classes/view.php');
include('classes/helper.php');
include('config/db.php');



// $_GET und $_POST zusammenfasen
$request = array_merge($_GET, $_POST);

// Controller erstellen
$controller = new Controller($request);

// Inhalt der Webanwendung ausgeben.
echo $controller->display();