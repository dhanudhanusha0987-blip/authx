<?php
session_start();

if(!isset($_POST["robot"]) || $_POST["math"] != $_SESSION["human_answer"]){
    $_SESSION["human_error"] = "Human verification failed.";
    header("Location: ../frontend/human_check.php");
    exit();
}

unset($_SESSION["human_answer"]);
$_SESSION["logged_in"] = true;

header("Location: ../dashboard/dashboard.php");
exit();