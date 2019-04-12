<?php
require "/opt/lampp/htdocs/Header.php";
?>
<main>
<div class="wrapper-main">
	<section class="section-default">
	<center><h1>SIGNUP</h1>
	<?php
	if (isset($_GET['error'])) 
	{
		if ($_GET['error']=="emptyfields") 
		{
			echo '<p class="signuperror">Fill in all fields!</p>';
		}
		elseif ($_GET['error']=="invaliduid") 
		{
			echo '<p class="signuperror">Invalid username!</p>'; 
			# code...
		}
		elseif ($_GET['error']=="passwordcheck&uid") 
		{
			echo '<p class="signuperror">Your password does not match!</p>'; 
			# code...
		}
		elseif ($_GET['error']=="invalidmail") 
		{
			echo '<p class="signuperror">Invalid mail!</p>'; 
			# code...
		}
		elseif ($_GET['error']=="usertaken") 
		{
			echo '<p class="signuperror">Username is already taken!</p>'; 
			# code...
		}

	}
	?>
	<form class="form-signup" action="includes/signup.inc.php" method="post">
		<input type="text" name="uid" placeholder="username"><br><br>
		<input type="text" name="mail" placeholder="email"><br><br>
		<input type="password" name="pwd" placeholder="password"><br><br>
		<input type="password" name="pwd-repeat" placeholder="repeat password"><br><br>
		<button type="submit" name="signup-submit"> Signup</button>
	</form>
	<?php
	if (isset($_GET["newpwd"])) 
	{
		if ($_GET["newpwd"]=="passwordupdated") 
		{
			echo '<p class="signuosuccess">Your password has been reset!</p>';
			# code...
		}
		# code...
	}
	?>
	<a href="reset-pass.php">Forgot your password?</a></center>
	</section>
</div>
	
</main>
<?php
require "footer.php";
?>






