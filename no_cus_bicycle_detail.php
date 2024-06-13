<?php
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

// 检查是否有ID传递
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // 查询数据库获取商品详情
    $stmt = $pdo->prepare("SELECT * FROM bicycle WHERE id = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Details</title>
    <style>
        /* 在这里添加你的CSS样式 */
        .product-container {
            display: flex;
            max-width: 1000px;
            margin: 20px auto;
            align-items: center;
        }
        .product-image {
            width: 50%;
        }
        .product-image img {
            width: 100%;
            max-width: 400px;
            height: auto;
        }
        .product-details {
            width: 50%;
            padding-left: 20px;
        }
        .order-button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="product-container">
        <div class="product-image">
            <img src="<?php echo htmlspecialchars($product['imgUrl']); ?>" alt="<?php echo htmlspecialchars($product['series']); ?>">
        </div>
        <div class="product-details">
            <h1><?php echo htmlspecialchars($product['series']); ?></h1>
            <p>Type: <?php echo $product['catogory'] == 0 ? 'Road' : 'Mountain'; ?></p>
            <p>Description: <?php echo htmlspecialchars($product['description']); ?></p>
            <p>Price: $<?php echo htmlspecialchars($product['price']); ?></p>
            <form action="order.php" method="get">
        	<input type="hidden" name="id" value="<?php echo htmlspecialchars($product['id']); ?>">
        	<button type="submit" class="order-button">Order Now</button>
    	    </form>
        </div>
    </div>
</body>
</html>
