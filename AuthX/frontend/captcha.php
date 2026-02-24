<?php
session_start();

/* ---------- ATTEMPT LIMIT ---------- */
if (!isset($_SESSION['captcha_attempts'])) {
    $_SESSION['captcha_attempts'] = 0;
}
if ($_SESSION['captcha_attempts'] >= 3) {
    header("Location: ../login.php?error=captcha_locked");
    exit;
}

/* ---------- URL-ENCODED SVG IMAGES ---------- */
$svgLeft = "data:image/svg+xml;utf8," . rawurlencode(
'<svg xmlns="http://www.w3.org/2000/svg" width="300" height="180">
  <rect width="300" height="180" fill="#e5e7eb"/>
  <circle cx="70" cy="70" r="22" fill="#2563eb"/>
  <rect x="55" y="95" width="30" height="50" rx="6" fill="#2563eb"/>
</svg>'
);

$svgRight = "data:image/svg+xml;utf8," . rawurlencode(
'<svg xmlns="http://www.w3.org/2000/svg" width="300" height="180">
  <rect width="300" height="180" fill="#e5e7eb"/>
  <circle cx="230" cy="70" r="22" fill="#2563eb"/>
  <rect x="215" y="95" width="30" height="50" rx="6" fill="#2563eb"/>
</svg>'
);

/* ---------- RANDOMIZE ---------- */
$correctSide = rand(0,1) === 0 ? "left" : "right";
$_SESSION['captcha_side'] = $correctSide;

$image = ($correctSide === "left") ? $svgLeft : $svgRight;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Human Verification | AuthX</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>
body{
    margin:0;
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:#f4f7fb;
    font-family:'Poppins',sans-serif;
}
.card{
    width:380px;
    background:#fff;
    padding:28px;
    border-radius:14px;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
    text-align:center;
}
.image-box{
    width:220px;
    height:140px;
    margin:18px auto;
    overflow:hidden;
    border-radius:10px;
}
.image-box img{
    width:100%;
    height:100%;
    object-fit:contain;
    filter: blur(1.8px) brightness(1.05);
}
.options{
    display:flex;
    justify-content:center;
    gap:25px;
    margin:10px 0;
}
button{
    width:100%;
    padding:12px;
    border:none;
    border-radius:8px;
    margin-top:10px;
    cursor:pointer;
    font-size:15px;
}
.verify{
    background:#2563eb;
    color:#fff;
}
.refresh{
    background:#e5e7eb;
    color:#111;
}
.error{
    color:#dc2626;
    font-size:13px;
}
</style>
</head>

<body>

<div class="card">
    <h2>Human Verification</h2>
    <p>Which side of the image shows the human?</p>

    <div class="image-box">
        <img src="<?= $image ?>" alt="Captcha Image">
    </div>

    <form method="post" action="../backend/verify_captcha.php">
        <div class="options">
            <label><input type="radio" name="side" value="left" required> Left</label>
            <label><input type="radio" name="side" value="right"> Right</label>
        </div>
        <button class="verify">Verify</button>
    </form>

    <button class="refresh" onclick="location.reload()">🔄 Refresh Image</button>

    <?php if(isset($_GET['error'])): ?>
        <div class="error">
            ❌ Wrong answer. Attempts left: <?= 3 - $_SESSION['captcha_attempts'] ?>
        </div>
    <?php endif; ?>
</div>

</body>
</html>