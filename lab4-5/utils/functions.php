<?php
	function generate_id()
	{
		$key = ''; 
		$array = array_merge(range('A','Z'),range('a','z'),range('0','9')); 
		$c = count($array); 
		for($i=0;$i<10;$i++) {$key .= $array[rand(0,$c)];} 
		return $key;
	}
?>