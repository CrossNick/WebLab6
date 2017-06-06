<?php

	require_once("controllers/user.php");
	//require_once("controllers/user/page-login.php");
	require_once("utils/functions.php");
	
	if(!isset($_GET["page"]))
	{
		redirect("index.php?page=user/login");
	}
	else if($_GET["page"]=="user/login")
	{	
		if(isset($_POST["submited"]) && $_POST["submited"]=="true")
		{
			action_login_post();
		}
		else
		{
			action_login();
		}
	}
	else if(isset($_POST["page"])&& $_POST["page"]=="user/profile")
	{
		action_profile_post();
	}
	else if($_GET["page"]=="user/profile")
	{	
		action_profile();
	}
	else if($_GET["page"]=="user/logout")
	{
		action_logout();
		redirect("index.php?page=user/login");
	}
	else if($_GET["page"]=="user/edit")
	{
		
		if(isset($_POST["submited"]) && $_POST["submited"]=="true")
		{
			action_edit_post();
			redirect("index.php?page=user/profile");
		}else
		{
			action_edit();
		}
	}

?>