<?php
if (isset($_POST['signup-submit'])) 
{

 require 'dbh.inc.php';

 $username=$_POST['uid'];
 $email=$_POST['mail'];
 $password=$_POST['pwd'];
 $passwordRepeat=$_POST['pwd-repeat'];
 
 if (empty($username) || empty($email)|| empty($password)|| empty($passwordRepeat) ) 
 {
 	header("location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
 	exit();
 }
 else if (!filter_var($email,FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
 	header("location: ../signup.php?error=invalidemail&uid");
 	exit();
 }
 else if (!filter_var($email,FILTER_VALIDATE_EMAIL)) 
 {
 	header("location: ../signup.php?error=invalidemail&uid=".$username);
 	exit();
 }
 else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) 
 {
 	# code...
 	header("location: ../signup.php?error=invalideuid&mail=".$email);
 	exit();
}
 elseif ($password!=$passwordRepeat) {
 	# code...
 	header("location: ../signup.php?error=passwordcheck&uid=".$username."&mail=".$email);
 	exit();
 }
 else
 {
 	$sql="SELECT uidUsers FROM users WHERE uidUsers=?";
 	$stmt=mysqli_stmt_init($conn);
 	if (!mysqli_stmt_prepare($stmt,$sql)) {
 		header("location: ../signup.php?error=sqlerror");
 	exit();
 		# code...
 	}
 	else
 	{
 		mysqli_stmt_bind_param($stmt,"s",$username);
 		mysqli_stmt_execute($stmt);
 		mysqli_stmt_store_result($stmt);
 		$resultcheck=mysqli_stmt_num_rows($stmt);
 		if($resultcheck>0)
 		{
 			header("location: ../signup.php?error=usertaken&mail=".$email);
 			exit();
 		}
 		else
 		{
 			$sql="INSERT  INTO  users(uidUsers,emailusers,pwdUsers) VALUES (? ,? , ?)";
 			$stmt=mysqli_stmt_init($conn);
 			if(!mysqli_stmt_prepare($stmt,$sql)) 
 			{
 				header("location: ../signup.php?error=sqlerror");
 				exit();
 			}
 			else
 			{
 				$hashpwd=password_hash($password,PASSWORD_DEFAULT);
 				mysqli_stmt_bind_param($stmt,"sss",$username,$email,$hashpwd);
 				mysqli_stmt_execute($stmt);
 				header("location: ../signup.php?signup=success");
 				exit();
 			}
 		}
 	}
 }
 mysqli_stmt_close($stmt);
 mysqli_close($conn);
}
else
{
	header("location: ../signup.php");
 				exit();
}
?>
