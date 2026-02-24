<?php
session_start();
require "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {

        if (password_verify($password, $user["password"])) {

            $otp = rand(100000, 999999);

            $_SESSION["otp"] = $otp;
            $_SESSION["otp_expires"] = time() + 60;
            $_SESSION["user_email"] = $email; // 🔥 IMPORTANT

            error_log("OTP for $email : $otp");

            header("Location: ../frontend/otp.php");
            exit();
        }
    }

    header("Location: ../frontend/login.php");
    exit();
}