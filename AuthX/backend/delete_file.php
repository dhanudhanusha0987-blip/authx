<?php
require_once "auth.php";

$type = $_GET['type'];   // Documents / Pictures / Downloads
$file = basename($_GET['file']);

$filePath = "$basePath/$type/$file";

if (file_exists($filePath)) {
    unlink($filePath);
}

header("Location: ../frontend/" . strtolower($type) . ".php");
exit;