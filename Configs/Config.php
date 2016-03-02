<?php
define('DB_SERVER', 'root.ctkhjtxaobbw.us-west-2.rds.amazonaws.com');
define('DB_USERNAME', 'phpmyadmin');
define('DB_PASSWORD', 'phpmyadmin');
define('DB_DATABASE', 'Cloud_A2');
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>