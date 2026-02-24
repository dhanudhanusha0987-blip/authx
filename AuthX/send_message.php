<?php
$conn = new mysqli("localhost", "root", "", "authx");

if ($conn->connect_error) {
    die("Database connection failed");
}

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$message = $_POST['message'] ?? '';

$stmt = $conn->prepare(
    "INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)"
);
$stmt->bind_param("sss", $name, $email, $message);
$stmt->execute();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Message Sent | AuthX</title>
<style>
    body {
        margin: 0;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Poppins', Arial, sans-serif;
        background: linear-gradient(135deg, #0f4cff, #1a73e8);
    }

    .card {
        background: #ffffff;
        padding: 40px;
        width: 420px;
        text-align: center;
        border-radius: 14px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.25);
        animation: fadeIn 0.6s ease;
    }

    .check {
        font-size: 48px;
        color: #1a73e8;
        margin-bottom: 10px;
    }

    h2 {
        margin: 10px 0;
        color: #1a73e8;
    }

    p {
        color: #555;
        font-size: 15px;
        line-height: 1.5;
    }

    a {
        display: inline-block;
        margin-top: 20px;
        padding: 12px 24px;
        background: #1a73e8;
        color: #fff;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 500;
        transition: background 0.3s ease;
    }

    a:hover {
        background: #0f4cff;
    }

    footer {
        margin-top: 20px;
        font-size: 12px;
        color: #777;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }
</style>
</head>
<body>

<div class="card">
    <div class="check">✔</div>
    <h2>Message Sent!</h2>
    <p>
        Thank you for contacting <strong>AuthX</strong>.<br>
        Your message has been securely stored and will be reviewed shortly.
    </p>

    <a href="frontend/index.html">Back to Authx Page</a>

    <footer>
        © 2026 AuthX Project · Secure Communication
    </footer>
</div>

</body>
</html>
