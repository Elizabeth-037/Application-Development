<?php
// submit_order.php
session_start();
include 'navbar.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_POST['userId']; 
    $bicycleId = $_POST['bicycleId'] ?? '';
    $num = $_POST['quantity'] ?? 0;
    $totalPrice = $_POST['totalPrice'] ?? 0;
    $deliveryName = $_POST['name'] ?? '';
    $deliveryPhone = $_POST['phone'] ?? '';
    $deliveryAddress = $_POST['address'] ?? '';
    $orderTime = date('Y-m-d H:i:s');

    if ($bicycleId && $num && $totalPrice && $deliveryName && $deliveryPhone && $deliveryAddress) {

        $stmt = $pdo->prepare("INSERT INTO `orders` (userId, bicycleId, num, totalPrice, deliveryName, deliveryPhone, deliveryAddress, orderTime) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$userId, $bicycleId, $num, $totalPrice, $deliveryName, $deliveryPhone, $deliveryAddress, $orderTime]);
        
        header('Location: order_success.php');
        exit();
    } else {
        exit('Please fill in all the fields.');
    }
} else {
    header('Location: order.php');
    exit();
}
?>
