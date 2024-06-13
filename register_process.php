<?php
$user = 'root';
$password = '';
$server = '127.0.0.1';
$database = 'project';

$name = $_POST['name'];
$email = $_POST['email'];
$pass = $_POST['password']; 

try {
    $pdo = new PDO("mysql:host=$server;dbname=$database", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO user (name, mailbox, password) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $email, $pass]);

    echo "register success";
} catch(PDOException $e) {
    echo "register error" . $e->getMessage();
}
$pdo = null;
?>
