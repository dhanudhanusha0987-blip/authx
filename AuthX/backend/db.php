<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "authx";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Database connection failed");
}
?>