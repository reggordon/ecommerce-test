<?php
$servername = "localhost";
$username = "webapp_user";
$password = "securepassword";
$database = "ecommerce";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
