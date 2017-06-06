<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
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
			height:400px;
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
		.message{
			font-size:12px;
			color:red;
		}
		#logbutton{
	
		}
	</style>
	<script>
		function check()
		{
			var name = document.getElementById("uname");
			var pass = document.getElementById("pass");
			if(name.value!="" && pass.value!="")
				document.getElementById("logbutton").disabled = false;
			else
				document.getElementById("logbutton").disabled = true;
		}
	</script>
</head>
<body>

<?php session_start(); ?>
	
<div>
<form method="post" action="index.php?page=user/login">
	<p><input id="uname" type="text" name="<?php echo FORM_LOGIN;?>"  required oninput="check()"></p>
	<p class = "message"><?php 
		if(isset($_SESSION["error_login"])) {
			$msg = $_SESSION["error_login"];
			echo "$msg"; 
		}
	?></p>
	<p><input id="pass" type="password" name="<?php echo FORM_PASSWORD;?>" required oninput="check()"></p>
	<p class = "message"><?php 
		if(isset($_SESSION["error_password"])) {
			$msg = $_SESSION["error_password"];
			echo "$msg"; 
		}
	?></p>
	<input type="hidden" name="submited" value="true">
	<p><input id="logbutton" type="submit" value="Login" disabled></p>
</form>
</div>
<?php session_destroy(); ?>

</body>
</html>