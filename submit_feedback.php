<?php
session_start();
include 'navbar.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = 'root';
    $password = '';
    $server = '127.0.0.1';
    $database = 'project';

    $orderId = $_POST['order_number'];
    $contactInfo = $_POST['contact_info'];
    $feedbackType = $_POST['feedback_type'];
    $feedbackContent = $_POST['feedback_content'];
    $urgency = $_POST['urgency'];
    $satisfaction = $_POST['satisfaction'];
    $addDescription = $_POST['additional_description'];

    $image = $_FILES['image'];
    $imagePath = 'newuploads/' . basename($image['name']);
    move_uploaded_file($image['tmp_name'], $imagePath);

    try {
        $pdo = new PDO("mysql:host=$server;dbname=$database", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO feedback (orderId, contactInfo, feedbackType, feedbackContent, urgency, satisfaction, addDescription, imagePath) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$orderId, $contactInfo, $feedbackType, $feedbackContent, $urgency, $satisfaction, $addDescription, $imagePath]);

        header('Location: feedback_success.php');
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>