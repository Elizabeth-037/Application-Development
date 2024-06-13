<?php
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
</head>
<body>

<h1>Welcome <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1>
<p>this is user center page</p>

</body>
</html>
