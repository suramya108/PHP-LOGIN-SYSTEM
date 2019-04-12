<?php
if (isset($_POST["reset-req-sub"])) {
	$selector=bin2hex(11111111);
	$token=11111111111111111111111111111111;

	$url="http://localhost/create-new-password.php?selector=" .$selector ."&validator=" .bin2hex($token);
	
	$exp=date("U") + 1800;
	require 'dbh.inc.php';
	
	$userEmail=$_POST["email"];
	
	$sql="DELETE FROM pwdReset WHERE pwdResetEmail=?";
	$stmt=mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$sql)) 
	{
		echo "There was an error!";
		exit();
		# code...
	}
	else 
	{
		mysqli_stmt_bind_param($stmt,"s",$userEmail);
		mysqli_stmt_execute($stmt);
		# code...
	}
	$sql="INSERT INTO pwdReset(pwdResetEmail,pwdResetSelector,pwdResetToken,pwdResetExpires) VALUES (?, ?, ?, ?);";
	$stmt=mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$sql)) 
	{
		echo "There was an error!";
		exit();
		# code...
	}
	else 
	{
		$hashedToken=password_hash($token,PASSWORD_DEFAULT);
		mysqli_stmt_bind_param($stmt,"ssss",$userEmail,$selector,$hashedToken,$exp);
		mysqli_stmt_execute($stmt);
	}
		mysqli_stmt_close($stmt);
		mysqli_close($conn);
		$to=$userEmail;
		$subject='Rsest your password.';
		$msg='<p> We recieved a password reset request. The link to reset your password is below. If you did not make this request,you can ignore this email.<br> Here is your password reset link:<br> <a href=' .$url.'>' .$url.'</a></p>';
		$header="From: Suramya Gupta <suramyagupta2@gmail.com>\r\n Reply-To: suramyagupta2@gmail.com\r\n
		Content-Type:text/html\r\n";
		mail($to, $subject, $msg, $header);
		header("location: ../reset-pass.php?reset=success");

		# code...
		
	
}

else
{
	header("location: ../index.php");
}
?>