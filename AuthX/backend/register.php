<?php
session_start();
require "db.php";

/* 1️⃣ Validate POST data */
if (
    empty($_POST['name']) ||
    empty($_POST['email']) ||
    empty($_POST['password'])
) {
    die("Form data missing");
}

$name  = trim($_POST['name']);
$email = trim($_POST['email']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

/* 2️⃣ Check existing user */
$check = $conn->prepare("SELECT id FROM users WHERE email = ?");
$check->bind_param("s", $email);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    header("Location: ../frontend/register.html?error=exists");
    exit();
}

/* 3️⃣ Insert new user */
$stmt = $conn->prepare(
    "INSERT INTO users (name, email, password) VALUES (?, ?, ?)"
);

$stmt->bind_param("sss", $name, $email, $password);

/* 🔴 IMPORTANT: show error if insert fails */
if (!$stmt->execute()) {
    die("Insert failed: " . $stmt->error);
}

/* 4️⃣ Success → redirect */
header("Location: ../frontend/register-success.html");
exit();