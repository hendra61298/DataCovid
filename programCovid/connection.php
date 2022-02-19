<?php
$servername = "localhost";
$username = "hendra";
$password = "hendra";
$dbname = "datacovid";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>