<?php
	include 'connect.php';
	ob_start();
	if (isset($_POST['name']))
	{
		$name = $_POST['name'];
		if (isset($_POST['day']))
		{$dd = $_POST['day'];}
		if (isset($_POST['month']))
		{$mm = $_POST['month'];}
		if (isset($_POST['year']))
		{$yyyy = $_POST['year'];}
		if (isset($_POST['rewardpoints']))
		{$rewardpoints = $_POST['rewardpoints'];}		
		if (isset($_POST['stages']))
		{$stages = $_POST['stages'];}
		if (isset($_POST['details']))
		{$content = $_POST['details'];}
		$details = nl2br($content);
		$file_URI = '';
		if(isset($_FILES["file"]) && $_FILES["file"]["error"] == 0)
		{
			$file = basename($_FILES['file']['name']);
			//$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
			$DOCUMENT_ROOT = 'http://techeagle.in';
			$upload_folder = $DOCUMENT_ROOT.'/tcap/taskfiles/';
			$file_URI = $upload_folder.$file;
			$tmp_path = $_FILES["file"]["tmp_name"];
			if(move_uploaded_file($_FILES["file"]["tmp_name"], "taskfiles/" . $_FILES["file"]["name"]))
			{
				echo "Upload Complete";
			}
			else
			{
				echo "Error";
			}
		}
		$taskid = uniqid();
		if((int)$mm<10)
			$mm = "0".$mm;
		if((int)$dd<10)
			$dd = "0".$dd;
		$deadline = $dd."-".$mm."-".$yyyy;
		if (isset($_GET['taskid']))
		{
			$taskid = $_GET['taskid'];
			$sql = "UPDATE tasks SET name='$name', deadline='$deadline', stages='$stages', rewardpoints='$rewardpoints', details='$details', expired='no' WHERE taskid='$taskid'";
			$result=mysqli_query($connect, $sql);
			if($result===false)
			{
				echo "error: " .mysqli_error();
			}
			header('Location: tasks.php');
		}
		else
		{
			$user_info="INSERT INTO tasks(name, taskid, deadline, stages, rewardpoints, details, fileuri, expired)VALUES('$name', '$taskid','$deadline', '$stages','$rewardpoints','$details','$file_URI', 'no')";
			$result=mysqli_query($connect, $user_info);
			if($result===false)
			{
				echo "error: " .mysqli_error();
			}
			$sql = "SELECT * FROM ca_users";
			$result2 = mysqli_query($connect, $sql);
			while($row2 = mysqli_fetch_array($result2))
			{
				$username = $row2['username'];
				$totalProgress = calculateTotalProgress($connect, $username);
				$sql = "UPDATE ca_users SET totalprogress = '$totalProgress' WHERE username = '$username'";
				$result3 = mysqli_query($connect, $sql);
				if($result3 == false)
					echo "error: " .mysqli_error();
			}
		}
	}
	function calculateTotalProgress($connect, $username)
	{
		$sql = "SELECT * FROM tasks";
		$result = mysqli_query($connect, $sql);
		$sum = 0;
		$numoftasks = 0;
		while($row = mysqli_fetch_array($result))
		{
			$progress = $row['progress'];
			$index = strpos($progress, $username.":");
			if($index !== false)
			{
				$index = $index + strlen($username) + 1;
				$progress = substr($progress, $index);
				$num = (int)substr($progress, 0, strpos($progress, ","));
				$deno = (int)$row['stages'];
				$sum = $sum + $num/$deno;
			}
			$numoftasks = $numoftasks + 1;
		}
		$total = $sum * 100 / $numoftasks;
		$totalprogress = (int)$total;
		return $totalprogress;
	}
?>
<html>
<body style="text-align: center;">
	<button type="button" onclick="location.href='./addtasks.html'">Add More Tasks</button>
</body>
</html>