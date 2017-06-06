<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>

	<script type="text/javascript">
		var currentPage = 1;
		var atEnd = false;

		function get_cookie ( cookie_name )
		{
			var results = document.cookie.match ( '(^|;) ?' + cookie_name + '=([^;]*)(;|$)' );
  			if ( results )
	  			return ( unescape ( results[2] ) );
  			else
    			return null;
		}

		function loadMore() {
			if(atEnd) {
				return;
			}
			const loadurl = "index.php?page=user/profile";
			const loadparams = "offset=" + (currentPage++);
			var request = new XMLHttpRequest();
			request.open("GET", "../lab4-5/api.php?action=data&method=get&sessionid=" + get_cookie("sessionid") + "&offset=" + (currentPage++));
			//request.open("POST", loadurl);
			//request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			request.onload = function loadCallback() {
				if(request.responseText) {
					var textElement = document.getElementById("text");
					var txt = request.responseText;
					txt = JSON.parse(txt);
					txt = txt.text;
					//alert(txt);
					if(txt)
						textElement.append(txt);
				} else {
					atEnd = true;
				}
			};
			request.send();
			//request.send(loadparams);
		}
	</script>
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
			background-color: white;
			text-align: center;
			height:auto;
			display:flex;
			align-items:center;
			margin:auto;
			margin-top:100px;
			display:block;
		}
		form{
			margin:auto;
			clear: both;
		}
		#text
		{
			display:block;
			clear: both;
		}
		
		input
		{
			margin:10px;
		}
	</style>
</head>
<body>
<div>
	<form action="index.php?page=user/logout" method="post">
		<p>
			Hello, <?php echo get_username(); ?>!
			<input type="hidden" name="submited" value="true">
			<input type="submit" value="Logout">
		</p>
	</form>
	<p id="text"><b><i>Your text:<br></i></b><?php echo params("text"); ?></p>
	<form id="controls">
		<input type = "button" value = "Edit" onClick='location.href="index.php?page=user/edit"'>
		<input type = "button"  value="Load more" onClick="loadMore()">
	</form>
	
</div>
</body>
</html>