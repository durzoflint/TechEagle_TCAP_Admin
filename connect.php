<?php 
$connect=mysqli_connect('localhost','tcap2017','tcap2017_base_admin','tcap2017_base');
if(!$connect)
{  echo "Error while connecting to Database.".mysql_errno() ;
 
}
$db=mysqli_select_db($connect, 'tcap2017_base');
?>