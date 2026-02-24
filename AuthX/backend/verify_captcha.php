<?php
session_start();

if (!isset($_POST['side'], $_SESSION['captcha_side'])) {
    header("Location: ../frontend/captcha.php");
    exit;
}

if ($_POST['side'] === $_SESSION['captcha_side']) {
    $_SESSION['captcha_attempts'] = 0;
    header("Location: ../frontend/behavioral-captcha.html");
} else {
    $_SESSION['captcha_attempts']++;
    header("Location: ../frontend/captcha.php?error=wrong");
}
exit;