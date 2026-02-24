<?php
require_once "auth.php";

$target = $_POST['target']; // Documents / Pictures / Downloads
$uploadDir = "$basePath/$target/";

if (!empty($_FILES['file']['name'])) {
    $fileName = basename($_FILES['file']['name']);
    move_uploaded_file($_FILES['file']['tmp_name'], $uploadDir . $fileName);
}

header("Location: ../frontend/" . strtolower($target) . ".php");
exit;