<!-- FTP-Server: alfa3085.alfahosting-server.de -->
<!-- User: web6f3 -->
<!-- PW: k17MP1 -->
<!-- Verzeichnis: /sts -->


<?php
/*
* Database configuration
*/

define("DB_HOSTNAME",    "localhost");
define("DB_USERNAME",    "web6");
define("DB_PASSWORD",    "jNECYqCn");
define("DB_NAME",        "usr_web_44");


$db_connection = mysql_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD)
or die("Keine Verbindung zur Datenbank möglich!");

$db_selected = mysql_select_db(DB_NAME);