<?php
// fetch_bike_image.php
session_start();

$user = 'root';
$password = '';
$server = '127.0.0.1';
$database = 'project';
$pdo = new PDO("mysql:host=$server;dbname=$database", $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

$category = $_POST['category'] ?? '';
$series = $_POST['series'] ?? '';
$color = $_POST['color'] ?? '';
$hub = $_POST['hub'] ?? '';

$query = "SELECT imgUrl, description, id FROM bicycle WHERE category = ? AND series = ? AND color = ? AND hub = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$category, $series, $color, $hub]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode([
    'id' => $row['id'],
    'description' => $row['description'],
    'imgUrl' => $row['imgUrl'] ?? 'https://encrypted-tbn3.gstatic.com/shopping?q=tbn:ANd9GcRbrOtIl2gloiuWtnKkKcgRcR2egM-PXGQim947-HKd5H26_IVQ_u234hadFXKhQHF9oJNIli3jmqULegjB4tPjTDwOWbTvSc9_qZ4DfKuu2fmcHJw8-6l1&usqp=CAc' 
]);
