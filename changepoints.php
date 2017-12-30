<?php
	include 'connect.php';
	$username = $_GET['username'];
	$prevpoints = $_GET['prevpoints'];
	if (isset($_POST['points']))
	{
		$points = $_POST['points'];
	}
	$totalpoints = (int)$points + (int)$prevpoints;
	$sql = "UPDATE ca_users SET points = '$totalpoints' WHERE username = '$username'";
	$result = mysqli_query($connect, $sql);
	if($result===false)
	{
		echo "error: " .mysqli_error();
	}
	else
	{
		header("Location:cadetails.php?username={$username}");
	}
?>