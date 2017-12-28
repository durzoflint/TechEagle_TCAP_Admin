<?php
	include 'connect.php';
	$taskid = $_GET['taskid'];
  $sql = "SELECT * FROM tasks WHERE taskid = '$taskid'";
  $result = mysqli_query($connect, $sql);
  $row = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Website Name</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./cs/cs.css">
  </head>
  <body>
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a a href="./index.php" class="navbar-brand">TCAP Admin</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li><a href="./index.php">Home</a></li>
            <li><a href="./tasks.php">Tasks</a></li>
            <li><a href="./ca.php">CA</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <div style="text-align: center;" class="container-fluid">
    	<h1>Edit task for TechEagle Campus Ambassadors</h1>
  		<form id="addtasks" method="post" action="./addtasks.php?taskid=<?php echo $taskid;?>" enctype="multipart/form-data">
  			<input style="text-align: center; margin-top: 5vh; width: 25vw;" required type="text" placeholder="Title" name="name" value="<?php echo $row['name'];?>"><br>
  			Deadline : 
        <?php
          $deadline = $row['deadline'];
          $day = intval(date('d', strtotime($deadline)));
          $month = intval(date('m', strtotime($deadline)));
          $year = intval(date('Y', strtotime($deadline)));
        ?>
  			<input style="text-align: center; margin-top: 5vh; width: 6vw;" required type="number" placeholder="DD" name="day" value="<?php echo $day;?>">
  			<input style="text-align: center; margin-top: 5vh; width: 6vw;" required type="number" placeholder="MM" name="month" value="<?php echo $month;?>">
  			<input style="text-align: center; margin-top: 5vh; width: 6vw;" required type="number" placeholder="YYYY" name="year" value="<?php echo $year;?>"><br>
  			<input style="text-align: center; margin-top: 5vh; width: 25vw;" required type="number" placeholder="Stages" name="stages" value="<?php echo $row['stages'];?>"><br>
  			<input style="text-align: center; margin-top: 5vh; width: 25vw;" required type="number" placeholder="Reward Points" name="rewardpoints" value="<?php echo $row['rewardpoints'];?>"><br>
  			<textarea style="margin-top: 5vh;  width: 25vw; resize: none;" rows="10" name="details" placeholder="Details" form="addtasks"><?php echo str_replace("<br />", "", $row['details']);?></textarea><br><br>
        <?php echo "File Selected<br>".$row['fileuri'];?>
        <br>
  			<input style="text-align: center; margin-top: 5vh;" class="btn" type="submit" name="submit" value="Add">
  		</form>
    </div>
  </body>
</html>