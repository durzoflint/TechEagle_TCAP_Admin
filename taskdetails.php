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
    <br>
    <div class="container-fluid col-sm-4">
      <?php
        include 'connect.php';
        $taskid = $_GET['taskid'];
        $sql = "SELECT * FROM tasks WHERE taskid = '$taskid'";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_array($result);
        $fileURI = $row['fileuri'];
        if($fileURI == '')
          $fileURI = 'File Not available';
        $stages = $row['stages'];
        echo "<strong>Task Name : </strong>".$row['name']."<br><strong>Deadline : </strong>".$row['deadline']."<br><strong>Stages : </strong>".$stages."<br><strong>Reward Points : </strong>".$row['rewardpoints']."<br><strong>Details : </strong>".$row['details']."<br><strong>File URL : </strong>".$fileURI."<br><strong>Expired : </strong>".$row['expired'];
        $progress = $row['progress'];
        $indexcomma = strpos($progress, ",");
        $attempted = 0;
        $completed = 0;
        while($indexcomma !== false)
        {
          $entry = substr($progress, 0, $indexcomma);
          $indexcolon = strpos($entry, ":");
          $username = substr($entry, 0, $indexcolon);
          $entry = substr($entry, $indexcolon + 1);
          $num = substr($entry, 0, $indexcomma);
          //echo $username." : ".$num."<br>";
          $attempted = $attempted + 1;
          if($num == $stages)
            $completed = $completed + 1;
          $progress = substr($progress, $indexcomma + 1);
          $indexcomma = strpos($progress, ",");
        }
        $sql = "SELECT * FROM ca_users";
        $result = mysqli_query($connect, $sql);
        $num_rows = mysqli_num_rows($result);
        if($attempted == 0)
          $percent1 = "0";
        else
          $percent1 = ($completed * 100 / $attempted)."";
        $percent2 = ($completed * 100 / $num_rows)."";
        $percent3 = ($attempted * 100 / $num_rows)."";
        if(strlen($percent1) > 6)
          $percent1 = substr($percent1, 0, 6);
        if(strlen($percent2) > 6)
          $percent2 = substr($percent2, 0, 6);
        if(strlen($percent3) > 6)
          $percent3 = substr($percent3, 0, 6);
        echo "<br><br><strong>Compeleted/Attempted : </strong>".$completed."/".$attempted." ($percent1%)";
        echo "<br><strong>Compeleted/All : </strong>".$completed."/".$num_rows." ($percent2%)";
        echo "<br><strong>Compeleted/All : </strong>".$attempted."/".$num_rows." ($percent3%)";
      ?>
    </div>
    <div>
      <?php
      ?>
    </div>
  </body>
</html>