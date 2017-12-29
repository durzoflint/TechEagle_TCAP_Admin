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
            <li class="active"><a>CA</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <br>
    <div style="overflow: auto;" class="container-fluid">
      <a href="./addca.html" class="btn btn-info">Add New CA</a>
      <br><br>
      <table class="table table-bordered">
        <thead>
          <th>S. No.</th>
          <th>Name</th>
          <th>TechEagle ID</th>
          <th>Email</th>
          <th>Tasks Attempted/Tasks Completed</th>
          <th>Points</th>
          <th>Total Progress</th>
          <th>Date of Birth</th>
          <th>Gender</th>
          <th>Number</th>
          <th>Address</th>
        </thead>
        <tbody>
          <?php
            include 'connect.php';
            $sql = "SELECT * FROM ca_users ORDER by tcap_id";
            $result = mysqli_query($connect, $sql);
            $i = 1;
            while ($row = mysqli_fetch_array($result))
            {
              $username = $row['username'];
              echo "<tr>
              <td>{$i}</td>
              <td>{$row['firstname']} {$row['lastname']}</td>
              <td>{$row['tcap_id']}</td>
              <td><a href='cadetails.php?username={$username}'>$username</a></td>
              <td>{Under Developement}</td>
              <td>{$row['points']}</td>
              <td>{$row['totalprogress']}</td>
              <td>{$row['dob']}</td>
              <td>{$row['gender']}</td>
              <td>{$row['number']}</td>
              <td>{$row['address']}</td>
              </tr>";
              $i++;
            }
          ?>
        </tbody>
      </table>
    </div>
  </body>
</html>