<?php
$servername ="localhost";
$dBUsername ="root";
$dBPassword ="";
$dBName ="login";

$conn=mysqli_connect($servername,$dBUsername,$dBPassword,$dBName);
if (!$conn) {
	die("connection aborted: ".mysqli_connect_error());
	# code...
}
?>