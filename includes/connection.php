<?php

//MySQL connection

$dbServer = "sql7.freemysqlhosting.net";
$dbUser = "sql7245902";
$dbPass = "r7IksiE9y3";
$dbName = "sql7245902";

$conn = mysqli_connect($dbServer, $dbUser, $dbPass, $dbName);

//PDO connection

$server = "sql7.freemysqlhosting.net";

$user = "sql7245902";

$pwd = "r7IksiE9y3";

try{
	
  $pdo = new PDO("mysql:host=$server;dbname=sql7245902", $user, $pwd);
  }

catch(PDOException $e)

  {

  echo "Database error";

  }

?>