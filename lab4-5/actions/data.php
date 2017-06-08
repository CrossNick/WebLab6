<?php
	function operate_data()
	{
		if(isset($_GET["method"]))
		{
			$method = $_GET["method"];
			if($method == "get")
				get();
			elseif($method == "set")
				set();
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

	function get()
	{
		if(isset($_GET["sessionid"]))
		{
			$offset = (isset($_GET["offset"]))?$_GET["offset"]:1;
			$id = $_GET["sessionid"];
			$file = $id.".txt";
			$dir = "internal/sessions/";
			$username = "";
			if (file_exists($dir.$file)){
				$fIn = fopen($dir.$file, 'r');
				$username = fgets($fIn);
				fclose($fIn);
				$file = $username.".txt";
				$dir = "internal/data/";
				if (file_exists($dir.$file)){
					$fIn = fopen($dir.$file, 'r');
					$txt = false;
					for($i = 0;$i<$offset;$i++)
						$txt = fgets($fIn);
					$arr = array("text"=>$txt, "errorMsg"=>null, "errorCode"=>0);
					echo json_encode($arr);
					fclose($fIn);
				}else
				{
					$fIn = fopen($dir.$file, 'w');
					$arr = array("text"=>"", "errorMsg"=>null, "errorCode"=>0);
					echo json_encode($arr);
					fclose($fIn);
				}
			}
			else
			{
				$arr = array("text"=>null, "errorMsg"=>"Invalid Session ID", "errorCode"=>5);
				echo json_encode($arr);
			}
		}
		else
			{
				$arr = array("text"=>null, "errorMsg"=>"Session ID is not set", "errorCode"=>5);
				echo json_encode($arr);
			}
	}

	function set()
	{
		if(isset($_GET["sessionid"]) && isset($_GET["text"]))
		{
			$username = "";
			$id = $_GET["sessionid"];
			$text = $_GET["text"];
			$file = $id.".txt";
			$dir = "internal/sessions/";
			if (file_exists($dir.$file)){
				$fIn = fopen($dir.$file, 'r');
				$username = fgets($fIn);
				fclose($fIn);
				$file = $username.".txt";
				$dir = "internal/data/";
				if (file_exists($dir.$file)){
					$fIn = fopen($dir.$file, 'w');
					fwrite($fIn, $text);
					fclose($fIn);
				}
				$arr = array("errorMsg"=>null, "errorCode"=>0);
				echo json_encode($arr);
			}
			else{
				$arr = array("errorMsg"=>"Invalid Session ID", "errorCode"=>100);//!!!! Возможно код ошибки 5
				echo json_encode($arr);
			}
		}
		else
			{
				$arr = array("errorMsg"=>"Session ID is not set", "errorCode"=>5);
				echo json_encode($arr);
			}
	}



?>