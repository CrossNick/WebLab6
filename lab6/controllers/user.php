<?php

const FORM_LOGIN = "login";
const FORM_PASSWORD = "pass";
const FORM_TEXT = "text";
const PARAM_USERNAME = "username";
const PARAM_PASSWORD = "password";
const PARAM_SESSIONID = "sessionid";
const PARAM_TEXT = "text";
const PARAM_OFFSET = "offset";
//require_once("../lab4/utils/constants.php");

function action_login($errors=null) {
	if(session() != null) {
		redirect("index.php?page=user/profile");
	}
	render("page-login.php");
}

function action_login_post() {
	if(isset($_POST[FORM_LOGIN]) && isset($_POST[FORM_PASSWORD])) {
		session_start(); // start php session just for error handling
		$response = api("user", "login", array(
			PARAM_USERNAME => $_POST[FORM_LOGIN],
			PARAM_PASSWORD => $_POST[FORM_PASSWORD],
		));
		if($response->errorCode === 0) {
			session($response->sessionid, $_POST[FORM_LOGIN]);
			redirect("index.php?page=user/profile");
		} else {
			switch($response->errorCode) {
				case 100:
				case 102:
					$errorType = "error_password";
					break;
				default:
					$errorType = "error_login";
					break;
			}
			$_SESSION[$errorType] = $response->errorMsg;
			redirect("index.php?page=user/login");
		}
	}
}

function action_profile() {
	if(session() != null) {		
		$offset = (isset($_GET["offset"]))?$_GET["offset"]:1;
		$response = api("data", "get", array(
			PARAM_SESSIONID => session(),
			PARAM_OFFSET => $offset
		));
		if($response->errorCode == 0) {
			render("page-profile.php", array(
				"text" => $response->text
			));
		}
		if ($response->errorCode == 5) {
			delete_session();
		}
	}
}

function action_profile_post() {
	if(session() != null) {
		$offset = (isset($_POST["offset"]))?$_POST["offset"]:1;
		$response = api("data", "get", array(
			PARAM_SESSIONID => session(),
			PARAM_OFFSET => $offset
		));
		if ($response->errorCode == 5) {
			delete_session();
		}
		if($response->errorCode == 0) {
			echo $response->text;
		}
	}
	exit();
}

function action_logout() {
	$response = api("user", "logout", array(
		PARAM_SESSIONID => session()
	));

	delete_session();
	redirect("index.php?page=user/login");
	//redirect("index.php?page=user/login");
}

function action_edit() {
	if(session() != null) {
		$offs = 1;
		$strres = "";
		$response = 0;
		do
		{
			$response = api("data", "get", array(
			PARAM_SESSIONID => session(),
			PARAM_OFFSET => $offs
			));
			$strres.=$response->text;
			$offs+=1;
		}while($response->errorCode == 0 && $response->text!=null);
		
		if($response->errorCode == 0) {
			render("page-edit.php", array(
				"text" => $strres
			));
		}
	}
}

function action_edit_post() {
	if(session() != null) {
		$response = api("data", "set", array(
			PARAM_SESSIONID => session(),
			PARAM_TEXT => (isset($_POST[FORM_TEXT]) ? $_POST[FORM_TEXT]: "")
		));
		if ($response->errorCode == 5) {
			delete_session();
		}
		if($response->errorCode == 0) {
			redirect("index.php?page=user/profile");
		} else {
			redirect("index.php?page=user/edit");
		}
	}
}

?>