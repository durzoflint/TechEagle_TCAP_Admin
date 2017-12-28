<?php
	include 'connect.php';
	$taskid = $_GET['taskid'];
	if(isset($_POST['edit']))
	{$action = $_POST['edit'];}
	if(isset($_POST['delete']))
	{$action = $_POST['delete'];}
	if ($action == 'edit')
	{
		header("Location: modifytask.php?taskid=$taskid");
	}
	elseif ($action == 'delete')
	{
		$sql = "DELETE FROM tasks WHERE taskid = '$taskid'";
		mysqli_query($connect, $sql);
		echo "Deleting";
		header('Location: tasks.php');
	}
?>