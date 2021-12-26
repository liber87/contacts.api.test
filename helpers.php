<?php
	function getError($txt,$code = 400){
		$codes = ['400'=>'Bad Request','200'=>'OK'];
		header("Content-type: application/json; charset=utf-8");
		header('HTTP/1.0 '.$code.' '.$codes['code']);
		if ($code==400) $key = 'error';
		else $key = 'message';
		echo json_encode(array(
			$key => $txt
		), JSON_UNESCAPED_UNICODE);		
		exit();
	}
	function isJSON($string){
		return is_string($string) && is_array(json_decode($string, true)) ? true : false;
	}