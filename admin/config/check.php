<?php
$servername   = "172.16.3.132";
$database = "xl_software2";
$username = "root";
$password = "pass";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}
  echo "Connected successfully";
?>
