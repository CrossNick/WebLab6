<?php

const API_URL = "http://localhost/lab4-5/api.php";

function strip_non_alphanum($value) {
	$escape = preg_replace("/[^A-Za-z0-9 ]/", '', $value);
	return $escape === $value ? $escape : null;
}

function render($file, $params=array()) {
	header("Content-Type: text/html");
	$GLOBALS['viewparams'] = $params;
	include("controllers/user/$file");
	exit();
}

function params($key = null) {
	return ($key == null) ? 
		(isset($GLOBALS['viewparams'])?$GLOBALS['viewparams']:null) : 
		(isset($GLOBALS['viewparams'][$key])?$GLOBALS['viewparams'][$key]: null);
}

function redirect($path, $pernament = false) {
	header("Location: $path", true, $pernament ? 301 : 302);
	exit();
}

function api($action, $method, $params) {
		
	$data = http_build_query($params);
	$url = API_URL . "?action=$action&method=$method&$data";
	$response_string = file_get_contents($url);
	$decoded = json_decode($response_string);
	if($decoded == null) {
		echo $response_string;
		//exit();
	} else {
		if(!isset($decoded->errorCode) || ($decoded->errorCode < 100 && $decoded->errorCode != 0)) {
			var_dump($decoded);
			//exit();
		}
		return $decoded;
	}
}

function session($sessionid=null, $user=null) {
	if($sessionid != null) {
		setcookie("sessionid", $sessionid);
		setcookie("username", $user);
	} else {
		if(isset($_COOKIE["sessionid"]))
			return $_COOKIE["sessionid"];
		else 
			return null;
	}
}

function get_username() {
	if(isset($_COOKIE["username"]))
			return $_COOKIE["username"];
		else 
			return null;
}

function delete_session() {
	if (isset($_COOKIE['sessionid'])) {
		unset($_COOKIE['sessionid']);
    	setcookie('sessionid', '', time() - 10000);
	}
	if (isset($_COOKIE['username'])) {
		unset($_COOKIE['username']);
		setcookie("username", '', time() - 10000);
	}
}

?>