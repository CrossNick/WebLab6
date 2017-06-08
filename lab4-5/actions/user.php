<?php
	function operate_user()
	{
		if(isset($_GET["method"]))
		{
			$method = $_GET["method"];
			if($method == "login")
				login();
			elseif($method == "logout")
				logout();
			else
			{
				$arr = array("method"=>null, "errorMsg"=>"Unknown method", "errorCode"=>100);
				echo json_encode($arr);
			}
		}
		else
		{
			$arr = array("method"=>null, "errorMsg"=>"Method is not set", "errorCode"=>100);
			echo json_encode($arr);
		}
	}

	function login()
	{
		if(isset($_GET["username"]) && isset($_GET["password"]))
		{
			$username = $_GET["username"];
			$password = $_GET["password"];
			global $users;
			if(isset($users[$username]))
			{
				if(is_match($username, $password))
				{
					$id = generate_id();
					$file = $id.".txt";
					$dir = "./internal/sessions/";
					if (!file_exists($dir.$file)){
						$fIn = fopen($dir.$file, 'w');
						fwrite($fIn, $username);
						fclose($fIn);
					}
					$arr = array("sessionid"=>$id, "errorMsg"=>null, "errorCode"=>0);
					echo json_encode($arr);
				}	
				else
				{
					$arr = array("sessionid"=>null, "errorMsg"=>"Wrong password!", "errorCode"=>102);
					echo json_encode($arr);
				}
			}
			else
			{
				$arr = array("sessionid"=>null, "errorMsg"=>"Wrong username!", "errorCode"=>103);
				echo json_encode($arr);
			}
			
		}
		else
		{
			$arr = array("sessionid"=>null, "errorMsg"=>"User data is not set", "errorCode"=>100);
			echo json_encode($arr);
		}
	}

	function logout()
	{
		if(isset($_GET["sessionid"]))
		{
			$file = $_GET["sessionid"].".txt";
			$dir = "internal/sessions/";
			if (file_exists($dir.$file))
			{
				unlink($dir.$file);
				$arr = array("errorMsg"=>null, "errorCode"=>0);
			}
			else{
				$arr = array("errorMsg"=>"Invalid Session ID", "errorCode"=>100);
				echo json_encode($arr);
			}
		}
		else
		{
			$arr = array("errorMsg"=>"Session ID is not set", "errorCode"=>100);
			echo json_encode($arr);
		}
	}
?>