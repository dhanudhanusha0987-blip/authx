<?php
session_start();
require "db.php";

/* Allow only POST */
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../frontend/login.php");
    exit;
}

$email    = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

/* Empty check */
if ($email === '' || $password === '') {
    $_SESSION['login_error'] = "Email and password are required.";
    header("Location: ../frontend/login.php");
    exit;
}

/* Fetch user */
$stmt = $conn->prepare(
    "SELECT id, name, email, password FROM users WHERE email = ?"
);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

/* ❌ Not registered */
if ($result->num_rows !== 1) {
    $_SESSION['login_error'] = "You are not registered. Please register first.";
    header("Location: ../frontend/login.php");
    exit;
}

$user = $result->fetch_assoc();

/* ❌ Wrong password */
if (!password_verify($password, $user['password'])) {
    $_SESSION['login_error'] = "Incorrect password. Please try again.";
    header("Location: ../frontend/login.php");
    exit;
}

/* ✅ SUCCESS */
$_SESSION['authx_user']  = $user['id'];
$_SESSION['authx_email'] = $user['email'];

/* Redirect */
header("Location: ../dashboard/index.php");
exit;
