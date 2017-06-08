<?php // test1.php
	require_once("actions/user.php");
	require_once("actions/data.php");
	require_once("utils/errors.php");
	require_once("utils/functions.php");
	require_once("internal/available-users.php");

	if(isset($_GET["action"]))
	{
		$action = $_GET["action"];
		if($action == "user")
			operate_user();
		elseif($action == "data")
			operate_data();
		else
			{
				$arr = array("action"=>null, "errorMsg"=>"Unknown action", "errorCode"=>100);
				echo json_encode($arr);
			}
	}	
	else
	{
				$arr = array("action"=>null, "errorMsg"=>"Action is not set", "errorCode"=>100);
				echo json_encode($arr);
	}
	
	
?>