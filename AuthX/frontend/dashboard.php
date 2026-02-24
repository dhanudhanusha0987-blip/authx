<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>AuthX Dashboard</title>
<style>
body{
    font-family:Poppins, Arial;
    background:#f4f6fb;
    padding:40px;
}
.card{
    background:white;
    padding:30px;
    border-radius:16px;
    max-width:500px;
    margin:auto;
    box-shadow:0 15px 40px rgba(0,0,0,0.2);
}
h2{color:#667eea;}
</style>
</head>
<body>
<div class="card">
<h2>Welcome to AuthX Dashboard 🔐</h2>
<p>OTP verified successfully.</p>
</div>
</body>
</html>