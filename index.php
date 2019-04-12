<?php
require "Header.php";
?>
<main>
<div class="wrapper-main">
	<section class="section-default">
	<?php
	if (isset($_SESSION['userid'])) 
	{
		echo '<p class="login-status">You are Logged in!</p>';
	}
	else
	{
		echo '<p class="login-status">You are Logged out! </p>';

	}
		
	?>	
	</section>
</div>
	
</main>
<?php
require "footer.php";
?>






