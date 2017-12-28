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
          <a class="navbar-brand">TCAP Admin</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li class="active"><a>Home</a></li>
            <li><a href="./tasks.php">Tasks</a></li>
            <li><a href="./ca.php">CA</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <br>
    <div class="container-fluid">
      <table class="table table-bordered">
        <thead>
          <th>S. No.</th>
          <th>CA Name</th>
          <th>TEID</th>
          <th>Email ID</th>
          <?php
            include 'connect.php';
            $sql = "SELECT * FROM tasks ORDER by deadline";
            $result = mysqli_query($connect, $sql);
            while ($row = mysqli_fetch_array($result))
            {
              echo "<th>{$row['name']}</th>";
            }
          ?>
        </thead>
        <tbody>
          <?php
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
              <td>{$username}</td>";
              $sql2 = "SELECT * FROM tasks ORDER by deadline";
              $result2 = mysqli_query($connect, $sql2);
              while ($row2 = mysqli_fetch_array($result2))
              {
                $progress = $row2['progress'];
                $index = strpos($progress, $username.":");
                if($index === false)
                {
                  echo "<td>0/{$row2['stages']}</td>";
                }
                else
                {
                  $leftSide = substr($progress, 0, $index);
                  $progress = substr($progress, $index);
                  $num = (int)substr($progress, 0, strpos($progress, ","));
                  echo "<td>{$num}/{$row2['stages']}</td>";
                }
              }
              echo "</tr>";
              $i++;
            }
          ?>
        </tbody>
      </table>
    </div>
  </body>
</html>