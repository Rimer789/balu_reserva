<?php
$servername = "containers-us-west-32.railway.app";
$username = "root";
$password = "4H1dff0QbQ9CYUbhNO1I";
$dbname = "railway";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
