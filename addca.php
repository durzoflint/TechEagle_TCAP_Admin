<?php
	include 'connect.php';
	ob_start();
	if (isset($_POST['email']))
	{
		$email = $_POST['email'];
		if (isset($_POST['teid']))
		{$teid = $_POST['teid'];}
		$user_info="INSERT INTO ca_users(username, tcap_id, totalprogress)VALUES('$email', '$teid', '0')";
		$result=mysql_query($user_info);
		if($result===false)
		{
			echo "error: " .mysql_error();
		}
	}
?>
<html>
<body style="text-align: center;">
	<button type="button" onclick="location.href='./addca.html'">Add More CAs</button>
</body>
</html>