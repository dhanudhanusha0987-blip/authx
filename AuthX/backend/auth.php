<?php
// Start session safely
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Block unauthenticated users
if (!isset($_SESSION['user_email'])) {
    header("Location: ../frontend/user_files.php");
    exit;
}

// Get logged-in user email
$email = $_SESSION['user_email'];

// Create a safe folder name from email
$userFolder = preg_replace('/[^a-zA-Z0-9]/', '_', strtolower($email));

// Base path for this user
$basePath = __DIR__ . "/../user_uploads/$userFolder";

// User folders (KEEP CONSISTENT EVERYWHERE)
$folders = [
    'Documents',
    'Pictures',
    'Downloads',
    'Videos',
    'Music'
];

// Create base user folder
if (!is_dir($basePath)) {
    mkdir($basePath, 0755, true);
}

// Create category folders
foreach ($folders as $folder) {
    $fullPath = $basePath . '/' . $folder;
    if (!is_dir($fullPath)) {
        mkdir($fullPath, 0755, true);
    }
}