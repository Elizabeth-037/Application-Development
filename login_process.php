<?php
session_start();

$dbUser = 'root'; 
$password = '';
$server = '127.0.0.1';
$database = 'project';

$email = $_POST['email'];
$pass = $_POST['password'];

try {
    $pdo = new PDO("mysql:host=$server;dbname=$database", $dbUser, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM user WHERE mailbox = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $userData = $stmt->fetch(PDO::FETCH_ASSOC); 

    if ($userData && $userData['password'] === $pass) {
        $_SESSION['user_id'] = $userData['id'];
        $_SESSION['user_name'] = $userData['name'];
        header('Location: NewWheels.html');
        exit();
    } else {

        echo "<script>
                alert('login fail, mailbox or password error');
                window.location.href = 'login.php';
              </script>";
    }
} catch(PDOException $e) {
    echo "Database error" . $e->getMessage();
    exit();
}

$pdo = null;
?>