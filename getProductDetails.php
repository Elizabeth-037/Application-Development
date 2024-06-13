
<?php

// getProductDetails.php

// getProductDetails.php
if (isset($_GET['id'])) {
    $productId = $_GET['id'];
$host = '127.0.0.1'; // 数据库主机名，使用IP地址可以避免某些环境下的DNS解析问题
$username = 'root'; // 数据库用户名
$password = ''; // 数据库密码，你的数据库没有密码
$dbname = 'project'; // 数据库名，更新为你的数据库名

// 使用新的数据库连接信息创建mysqli连接
$db = new mysqli($host, $username, $password, $dbname);
    if ($db->connect_error) {
        die("连接失败: " . $db->connect_error);
    }

    $stmt = $db->prepare("SELECT * FROM bicycle WHERE id = ?");
    $stmt->bind_param('i', $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $db->close();

    if ($product) {
        echo json_encode($product);
    } else {
        echo json_encode([]); // Ensure empty array or object is returned if no data
    }
}



?>
