<?php
	$users = array(
		"Ivan" => "Kach",
		"Vasya" => "1234",
		"Tolya" => "Nagibator228" 
	);

	function is_match($key, $value)
	{
		global $users;
		return $users[$key] == $value;
	}
?>