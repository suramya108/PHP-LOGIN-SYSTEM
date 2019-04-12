<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="description" content="example of meta tag description">
<meta name=viewport content="width=device-width,initial-scale=1">
 	<title></title>
 	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body background="2-2.png">

	<header> 
<style>
body{
	margin: 0px;
}
.a{
	height: 30%;
	width: 100%;
	font-size: 150%;
	text-decoration: underline;
	text-align: center;

}
.header-logo{
	height: 100%;
	width: 100%;
	/*background-image: url("2-2.png");*/
	font-family: georgia;
	font-size: 160%;
	
}
.img{
	height: 5%;
	width: 5%;
}
.nav {
  background-color: white; 
  list-style-type: none;
  text-align: left;
  margin: 0;
  padding: 0;
}
.nav li{
	display: inline-block;
	font-size: 20px;
	padding: 20px;
}
</style>
<div class="img">
<!-- <a target="_blank" href="index.jpeg">
 --><img src="index.jpeg" alt="logo"></div>
<ul class="nav">

		<li><a href="index.php">Home</a></li>
		<li><a href="#">Portfolio</a></li>
		<li><a href="#">About Me</a></li>
		<li><a href="#">Contact</a></li>
	</ul></div>
<div class="a">LOGIN</div>

<nav class="nav-header-main">
	<a class="header-logo" href="index.php">
		
	</a>
	
	<div class="header-login"><center>
	<?php
	if (isset($_SESSION['userid'])) 
	{
		echo '<form action="includes/logout.inc.php" method="post">
		 <button type="submit" name="logout-submit">LOGOUT</button></p>';
	}
	else
	{
		echo '<form action="includes/login.inc.php" method="post">
			 <input type="text" name="mailuid" placeholder="Username/E-mail..."><br><br>
			 <input type="password" name="pwd" placeholder="Password..."><br><br>
			 <button type="submit" name="login-submit">LOGIN</button><br><br>
		</form>
		<a href="signup.php">SIGN UP</a><br><br>';

	}
	?>
	
		

	</div>

</nav>
</header>
</body>
</html>