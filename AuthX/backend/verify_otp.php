<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (time() > $_SESSION["otp_expires"]) {
        session_destroy();
        $_SESSION["otp_error"] = "OTP expired. Please login again.";
header("Location: ../frontend/otp_expired.php");
exit();
    }

    if ($_POST["otp"] == $_SESSION["otp"]) {
        unset($_SESSION["otp"]);
        unset($_SESSION["otp_expires"]);
        header("Location: ../frontend/captcha.php");
        exit();
    } else {
        echo "Invalid OTP";
    }
}