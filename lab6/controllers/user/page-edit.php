<!DOCTYPE html>
<html>
<head>
	<title>Edit</title>
	<style type="text/css">
		body{
			background-image:url(fon17.jpg);
			background-repeat:no-repeat;
			background-size:100%;
		}
		div{
			
			border-color: black;
			border-style: solid;
			border-width: 5px;
			width:400px;
			height:auto;
			background-color: white;
			text-align: center;
			min-height:100%;
			display:flex;
			align-items:center;
			margin:auto;
			margin-top:100px;
		}
		form{
			margin:auto;
			
		}
		textarea
		{
			width:300px;
			height:300px;
			resize:none;
			clear:both;
		}
		input
		{
			
			margin:5px;
		}
	</style>
</head>
<body>
	<div>
	<form action="index.php?page=user/edit" method="post">
		
		<input type = "button" value = "Back" onClick='location.href="index.php?page=user/profile"'>
		<p><textarea name="<?php echo FORM_TEXT;?>"><?php echo params("text");?></textarea></p>
		<input type="hidden" name="submited" value="true">
		<p><input type="submit" value="Save"></p>
	</form>
	</div>
</body>
</html>