<?php
session_start();

/* 🔐 PROTECT DASHBOARD */
if (!isset($_SESSION['user_email'])) {
    header("Location: ../frontend/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>AuthX Dashboard</title>

<style>
/* ---------- GLOBAL ---------- */
body{
    margin:0;
    min-height:100vh;
    font-family:'Poppins', Arial, sans-serif;
    background:linear-gradient(270deg,#667eea,#764ba2,#43cea2);
    background-size:600% 600%;
    animation:bgMove 12s ease infinite;
    display:flex;
    align-items:center;
    justify-content:center;
}
@keyframes bgMove{
    0%{background-position:0% 50%}
    50%{background-position:100% 50%}
    100%{background-position:0% 50%}
}

/* ---------- CARD ---------- */
.dashboard{
    width:900px;
    max-width:95%;
    background:rgba(255,255,255,0.18);
    backdrop-filter:blur(18px);
    border-radius:20px;
    padding:40px;
    box-shadow:0 30px 70px rgba(0,0,0,0.35);
    color:#fff;
    animation:pop 0.8s ease;
}
@keyframes pop{
    from{transform:scale(0.95);opacity:0}
    to{transform:scale(1);opacity:1}
}

/* ---------- HEADER ---------- */
.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:30px;
}
.header h1{
    margin:0;
    font-size:28px;
}
.user{
    font-size:14px;
    opacity:0.9;
}

/* ---------- GRID ---------- */
.grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
}

/* ---------- BOX ---------- */
.box{
    background:rgba(255,255,255,0.2);
    border-radius:16px;
    padding:25px;
    box-shadow:0 10px 30px rgba(0,0,0,0.25);
    transition:0.3s;
}
.box:hover{
    transform:translateY(-6px);
}
.box h3{
    margin:0 0 10px;
    font-size:18px;
}
.box p{
    font-size:13px;
    opacity:0.9;
    line-height:1.6;
}

/* ---------- STATUS COLORS ---------- */
.green{border-left:5px solid #2ecc71;}
.blue{border-left:5px solid #00c6ff;}
.orange{border-left:5px solid #ffb347;}
.pink{border-left:5px solid #ff6ec4;}

/* ---------- LOGOUT ---------- */
.logout{
    margin-top:30px;
    text-align:center;
}
.logout a{
    display:inline-block;
    padding:12px 30px;
    border-radius:30px;
    background:linear-gradient(135deg,#ff512f,#dd2476);
    color:#fff;
    text-decoration:none;
    font-weight:600;
    box-shadow:0 10px 30px rgba(221,36,118,0.6);
    transition:0.3s;
}
.logout a:hover{
    transform:translateY(-2px);
    opacity:0.9;
}
</style>
</head>

<body>

<div class="dashboard">

    <div class="header">
        <h1>Welcome to AuthX 🔐</h1>
        <div class="user">
            Logged in as <b><?php echo htmlspecialchars($_SESSION['user_email']); ?></b>
        </div>
    </div>

    <div class="grid">
        <div class="box green">
            <h3>Login Status</h3>
            <p>You are successfully logged in and your session is active.</p>
        </div>

        <div class="box blue">
            <h3>Account Security</h3>
            <p>Password hashing and secure authentication are enabled.</p>
        </div>

        <div class="box orange">
            <h3>MFA Status</h3>
            <p>Multi-Factor Authentication setup is pending.</p>
        </div>

        <div class="box pink">
            <h3>Threat Monitoring</h3>
            <p>No suspicious activity detected on your account.</p>
        </div>
    </div>

    <div class="logout">
        <a href="../backend/logout.php">Logout</a>
    </div>

</div>

</body>
</html>