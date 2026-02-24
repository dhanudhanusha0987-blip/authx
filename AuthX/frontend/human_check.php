<?php
session_start();
$_SESSION["human_answer"] = rand(5,9) + rand(1,5);
?>
<!DOCTYPE html>
<html>
<head>
<title>AuthX | Human Verification</title>
<style>
body{
    margin:0;height:100vh;display:flex;justify-content:center;align-items:center;
    background:linear-gradient(135deg,#1a73e8,#00c6ff);
    font-family:Poppins,Arial;
}
.card{
    background:#fff;width:420px;padding:40px;border-radius:18px;
    text-align:center;box-shadow:0 25px 50px rgba(0,0,0,.3);
}
h2{color:#1a73e8;}
input,button{width:100%;padding:12px;font-size:16px;margin-top:10px;}
button{background:#1a73e8;color:#fff;border:none;border-radius:8px;}
.error{color:red;font-size:14px;}
</style>
</head>
<body>

<div class="card">
<h2>Human Verification</h2>

<?php if(isset($_SESSION["human_error"])): ?>
<div class="error"><?= $_SESSION["human_error"]; ?></div>
<?php unset($_SESSION["human_error"]); endif; ?>

<form action="../backend/verify_human.php" method="POST">
<label>
<input type="checkbox" name="robot" required> I am not a robot
</label>

<p><strong>Solve:</strong> What is <?= $_SESSION["human_answer"] - rand(1,5); ?> + <?= rand(1,5); ?> ?</p>

<input type="number" name="math" placeholder="Enter answer" required>
<button>Verify & Continue</button>
</form>
</div>

</body>
</html>