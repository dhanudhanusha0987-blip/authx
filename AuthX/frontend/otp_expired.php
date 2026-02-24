<?php
session_start();
$message = $_SESSION["otp_error"] ?? "OTP expired.";
unset($_SESSION["otp_error"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>AuthX | OTP Expired</title>

<style>
body{
    margin:0;
    height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    font-family:Poppins, Arial, sans-serif;
    background:linear-gradient(135deg,#ff416c,#ff4b2b);
}
.card{
    background:#fff;
    width:420px;
    padding:40px;
    border-radius:18px;
    text-align:center;
    box-shadow:0 30px 60px rgba(0,0,0,.35);
}
.icon{
    font-size:60px;
    color:#ff4b2b;
}
h2{
    margin:15px 0 10px;
    color:#ff4b2b;
}
p{
    font-size:15px;
    color:#555;
    margin-bottom:25px;
}
button{
    width:100%;
    padding:12px;
    border:none;
    border-radius:10px;
    background:#ff4b2b;
    color:#fff;
    font-size:16px;
    cursor:pointer;
}
button:hover{
    background:#d73820;
}
</style>
</head>

<body>

<div class="card">
    <div class="icon">⏱️</div>
    <h2>OTP Expired</h2>
    <p><?= htmlspecialchars($message) ?></p>

    <form action="login.php">
        <button>Go Back to Login</button>
    </form>
</div>

</body>
</html>