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
            <li class="active"><a>Tasks</a></li>
            <li><a href="./ca.php">CA</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <br>
    <div class="container-fluid">
      <a href="./addtasks.html" class="btn btn-info">Add New Tasks</a>
      <br><br>
      <table class="table table-bordered">
        <thead>
          <th>S. No.</th>
          <th>Name</th>
          <th>Deadline</th>
          <th>Stages</th>
          <th>Reward points</th>
          <th>File Location</th>
          <th>Details</th>
          <th>Expired</th>
        </thead>
        <tbody>
          <?php
            include 'connect.php';
            $sql = "SELECT * FROM tasks ORDER by expired, deadline";
            $result = mysqli_query($connect, $sql);
            $i = 1;
            while ($row = mysqli_fetch_array($result))
            {
              echo "<tr>
              <td>{$i}</td>
              <td>{$row['name']}</td>
              <td>{$row['deadline']}</td>
              <td>{$row['stages']}</td>
              <td>{$row['rewardpoints']}</td>
              <td>{$row['fileuri']}</td>
              <td>{$row['details']}</td>
              <td>{$row['expired']}</td>
              </tr>";
              $i++;
            }
          ?>
        </tbody>
      </table>
    </div>
  </body>
</html>