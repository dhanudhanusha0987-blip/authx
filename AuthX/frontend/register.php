<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../frontend/register.html");
    exit();
}

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$password = $_POST['password'];

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Check duplicate
$check = $conn->prepare("SELECT id FROM users WHERE email = ?");
$check->bind_param("s", $email);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    die("Email already registered");
}

// Insert
$stmt = $conn->prepare(
    "INSERT INTO users (name, email, password) VALUES (?, ?, ?)"
);
$stmt->bind_param("sss", $name, $email, $hashedPassword);

if ($stmt->execute()) {
    header("Location: ../frontend/register-success.html");
    exit();
}

die("Registration failed");