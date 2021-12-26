<?php
$method = $_SERVER['REQUEST_METHOD'];
$url = (isset($_GET['q'])) ? $_GET['q'] : '';
$url = rtrim($url, '/');
$urls = explode('/', $url);
if($_REQUEST['q']==''){
	echo file_get_contents('home.html');
	exit();
}
include_once('./helpers.php');
if (file_exists('./api/'.$urls[0].'.php')){	
	include_once('./connect.php');	
	include_once('./api/'.$urls[0].'.php');
} else {
	
	getError('Bad request');
}