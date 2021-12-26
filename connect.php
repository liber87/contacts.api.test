<?php
	
$db_server		= 'localhost';	
$db_user		= 'root';
$db_password	= '';
$db_name		= 'contacts';

$mysqli = new mysqli($db_server, $db_user, $db_password, $db_name);
if (mysqli_connect_errno()) { 
    printf("Connect failed: %s\n", mysqli_connect_error()); 
    exit(); 
}

$mysqli->set_charset('utf8');
$mysqli->set_charset('utf8');