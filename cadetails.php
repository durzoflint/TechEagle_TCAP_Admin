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
    <div class="container-fluid">
      <?php
        include 'connect.php';
        $username = $_GET['username'];
        $sql = "SELECT * FROM ca_users WHERE username = '$username'";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_array($result);
        $points = $row['points'];
        echo "<strong>Name : </strong>".$row['firstname']." ".$row['lastname']."<br><strong>Email : </strong>".$row['username']."<br><strong>TechEagle Id : </strong>".$row['tcap_id']."<br><strong>Number : </strong>".$row['number']."<br><strong>Points : ".$points."</strong><br><strong>Date of Birth : </strong>".$row['dob']."<br><strong>Gender : </strong>".$row['gender']."<br><strong>Address :</strong> ".$row['address']."<br><strong>Total Progress :</strong> ".$row['totalprogress']."%<br><br>";
        $sql = "SELECT * FROM tasks";
        $result = mysqli_query($connect, $sql);
        while($row = mysqli_fetch_array($result))
        {
          $taskid = $row['taskid'];
          $progress = $row['progress']."<br>";
          $index = strpos($progress, $username.":");
          echo "<strong>Task Name : </strong>".$row['name']."<br><strong>Deadline : </strong>".$row['deadline']."<br><strong>Completion : </strong>";
          if($index !== false)
          {
            $index = $index + strlen($username) + 1;
            $progress = substr($progress, $index);
            $index = strpos($progress, ",");
            $num = (int)substr($progress, 0, $index);
            echo $num;
          }
          else
          {
            echo "0";
          }
          echo "/".$row['stages']."<br><p style='float:left;'><strong>Bonus :&nbsp;</strong></p>";
          echo "<form action='changepoints.php?username={$username}&prevpoints={$points}' method='POST'>
                  <input name='points' type='number'>
                  <input type='submit'>
                </form><br>";
          echo "<strong>Feedback/Query</strong><br>";
          $sql2 = "SELECT * FROM feedback_and_query WHERE username = '$username' AND taskid = '$taskid'";
          $result2 = mysqli_query($connect, $sql2);
          $i = 1;
          while($row2 = mysqli_fetch_array($result2))
          {
            echo $i.") ".$row2['feedback']."<br>";
            $i = $i + 1;
          }
          echo "<br>";
        }
      ?>
    </div>
  </body>
</html>