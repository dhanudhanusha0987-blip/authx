<?php
session_start();
if (!isset($_SESSION["otp"])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>AuthX | OTP Verification</title>
<style>
body{
    margin:0;
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(135deg,#7f00ff,#1a73e8);
    font-family:Poppins, Arial;
}
.card{
    background:#fff;
    padding:40px;
    width:380px;
    border-radius:16px;
    text-align:center;
    box-shadow:0 20px 40px rgba(0,0,0,.3);
}
h2{color:#1a73e8}
input{
    width:100%;
    padding:12px;
    margin:15px 0;
    font-size:16px;
}
button{
    width:100%;
    padding:12px;
    background:#1a73e8;
    color:white;
    border:none;
    border-radius:8px;
    font-size:16px;
}
.timer{
    margin-top:10px;
    color:red;
    font-weight:bold;
}
</style>
</head>
<body>

<div class="card">
<h2>OTP Verification</h2>

<form action="../backend/verify_otp.php" method="POST">
    <input type="number" name="otp" placeholder="Enter OTP" required>
    <button>Verify OTP</button>
</form>

<div class="timer" id="timer">OTP expires in 60 seconds</div>
</div>

<script>
let time = 60;
setInterval(()=>{
    time--;
    document.getElementById("timer").innerText =
        "OTP expires in " + time + " seconds";
    if(time<=0){
        document.getElementById("timer").innerText =
            "OTP expired. Please login again.";
    }
},1000);
</script>

</body>
</html>