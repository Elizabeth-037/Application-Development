<?php
// order_success.php
session_start();
include 'navbar.php';
if (!isset($_SESSION['user_name'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="5;url=NewWheels.html">
    <title>Order Successful</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            text-align: center;
        }
        .success-message {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px;
        }
    </style>
</head>
<body>
    <div class="success-message">
        <h1>Order Placed Successfully!</h1>
        <p>Your order has been placed and is being processed. You will be redirected to the main page shortly.</p>
    </div>
</body>
</html>
