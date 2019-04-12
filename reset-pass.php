<?php
require "/opt/lampp/htdocs/Header.php";
?>
<main>
<div class="wrapper-main">
	<section class="section-default">
	<center><h1>Reset Your Password</h1>
	</center>
	<p> An e-mail will be sent to you with instructions on how to reset your password.</p>
	<form action="includes/reset-req.inc.php" method="post">
		<input type="text" name="email" placeholder="Enter your e-mail address...">
		<button type="submit" name="reset-req-sub"> Receive new password by e-mail.</button>
	</form>
	<?php
	if (isset($_GET["reset"])) 
	{
		if($_GET["reset"]=="success")
		{
			echo '<p class="signupsuccess"> Check your e-mail!</p>';
		}
		# code...
	}
	?>
	</section>
</div>
	
</main>
<?php
require "footer.php";
?>






