<?php
if (isset($_POST["reset-pass-submit"])) 
{
	$selector=$_POST["selector"];
	$validator=$_POST["validator"];
	$password=$_POST["pwd"];
	$pwdRepeat=$_POST["pwd-repeat"];

	if (empty($password) || empty($pwdRepeat))
	{
		header("location: ../create-new-password.php?newpwd=empty");
		exit();
	}
	elseif ($password!=$pwdRepeat) 
	{
		header("location: ../create-new-password.php?");
		exit();
		# code...
	}
	$currDate=date("U");
	require 'dbh.inc.php';

	$sql="SELECT * FROM pwdReset WHERE pwdResetSelector=? AND pwdResetExpires>= ?";
	$stmt=mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$sql)) 
	{
		echo "There was an error!";
		exit();
		# code...
	}
	else 
	{
		mysqli_stmt_bind_param($stmt,"ss",$selector,$currDate);
		mysqli_stmt_execute($stmt);

		$result=mysqli_stmt_get_result($stmt);
		if(!$row=mysqli_fetch_assoc($result))
		{
			echo "You need to re-submit your reset request.";
			exit();
		}
		else
		{
			$tokenBin=hex2bin($validator);
			$tokenCheck=password_verify($tokenBin,$row["pwdResetToken"]);
			if($tokenCheck== false)
			{
				echo "You need to re-submit your reset request.";
				exit();
			}
			else if ($tokenCheck== true) 
			{
				$tokenEmail=$row['pwdResetEmail'];
				$sql="SELECT * FROM users WHERE emailusers=?;";
				$stmt=mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt,$sql)) 
			{
				echo "There was an error!";
				exit();
			# code...
			}
			else 
			{
			mysqli_stmt_bind_param($stmt,"s",$tokenEmail);
			mysqli_stmt_execute($stmt);
			$result=mysqli_stmt_get_result($stmt);
			if(!$row=mysqli_fetch_assoc($result))
			{
				echo "There was an error.";
				exit();
			}
			else
			{
				$sql="UPDATE users SET pwdUsers=? WHERE emailusers=?";
					if (!mysqli_stmt_prepare($stmt,$sql)) 
				{
					echo "There was an error!";
					exit();
				# code...
				}
				else 
				{
					$newpwdHash=password_hash($password,PASSW
						_DEFAULT);
					mysqli_stmt_bind_param($stmt,"ss",$newpwdHash,$tokenEmail);
					mysqli_stmt_execute($stmt);


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
						mysqli_stmt_bind_param($stmt,"s",$tokenEmail);
						mysqli_stmt_execute($stmt);
						header("location: ../signup.php=newpwd=passwordupdated");
						# code...
					}


				}
		}
				# code...
			}
		}
		# code...
	}
	# code...
}
else
{
	header("location: ../index.php");
}
?>