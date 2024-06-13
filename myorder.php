<?php
// order.php
session_start();
include 'navbar.php';
if (!isset($_SESSION['user_name'])) {
    header('Location: login.php');
    exit();
}
$user = 'root';
$password = '';
$server = '127.0.0.1';
$database = 'project';
$pdo = new PDO("mysql:host=$server;dbname=$database", $user, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        h2 {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            margin: 0;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 4px 2px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <!-- (C) ORDER LIST -->
    <h2>Order List</h2>
    <?php
    // Connect to your database (use the db.php file you created)
    require "dblogin.php";

    // Retrieve data from the database based on customer's email
    $userId = $_SESSION['user_id']; 
    $sql = "SELECT id,orderTime,totalPrice,bicycleId,num,deliveryAddress  FROM orders WHERE userId = '$userId'";
    $result = mysqli_query($conn, $sql);

    // Display data in the table
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<h2>Order ID: {$row['id']}</h2>";
            echo "<table>";
            echo "<tr><th>Order Time</th><th>Total Price</th><th>Bicycle ID</th><th>Quantity</th><th>Delivery Address</th><th>Actions</th></tr>";
            echo "<tr>";
            echo "<td>{$row['orderTime']}</td>";
            echo "<td>{$row['totalPrice']}</td>";
            echo "<td>{$row['bicycleId']}</td>";
            echo "<td>{$row['num']}</td>";
            echo "<td>{$row['deliveryAddress']}</td>";
            echo "<td>";
            echo "<button>Modify</button> | ";
            echo "<button>Cancel</button>";
            echo "</td>";
            echo "</tr>";
            echo "</table>";
        }
    } else {
        echo "No orders found.";
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
    <div style="text-align: center; margin-top: 20px;">
        <button onclick="window.location.href='feedback.php';">Submit Feedback</button>
    </div>
</body>
</html>