<?php 
// Klassen einbinden
include('classes/controller.php');

foreach (glob("models/*.php") as $filename) {
    include $filename;
}

include('classes/view.php');
include('classes/helper.php');
include('config/db.php');



// $_GET und $_POST zusammenfasen
$request = array_merge($_GET, $_POST);

// Controller erstellen
$controller = new Controller($request);

// Inhalt der Webanwendung ausgeben.
echo $controller->display();