<?php
// 连接数据库
$host = '127.0.0.1'; 
$username = 'root'; 
$password = ''; 
$dbname = 'project'; 

// 使用新的数据库连接信息创建mysqli连接
$conn = new mysqli($host, $username, $password, $dbname);

// 检查连接是否成功
if ($conn->connect_error) {
    
   
die("数据库连接失败: " . $conn->connect_error);
}

// 你的查询语句保持不变
$sql = "SELECT id, imgUrl, category, price, series FROM bicycle"; // 查询数据库获取图片地址和id
$result = $conn->query($sql);

$images = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $imageData = array(
            'id' => $row['id'],
            'imgUrl' => $row['imgUrl'],
            'category' => $row['category'],
            'price' => $row['price'],
            'series'=> $row['series'],
        );
        $images[] = $imageData;
    }
}

// 返回 JSON 格式的图片地址和id数据
header('Content-Type: application/json');
echo json_encode($images);

// 关闭数据库连接
$conn->close();
?>
