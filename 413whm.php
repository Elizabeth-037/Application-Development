<?php
// 连接数据库
$host = '127.0.0.1'; // 数据库主机名，使用IP地址可以避免某些环境下的DNS解析问题
$username = 'root'; // 数据库用户名
$password = ''; // 数据库密码，你的数据库没有密码
$dbname = 'project'; // 数据库名，更新为你的数据库名

// 使用新的数据库连接信息创建mysqli连接
$db = new mysqli($host, $username, $password, $dbname);

// 检查连接是否成功
if ($db->connect_error) {
    
   
die("数据库连接失败: " . $conn->connect_error);
}

// 获取商品ID
$productId = isset($_GET['id']) ? $_GET['id'] : '17';

// 查询数据库获取商品详情
$sql = "SELECT * FROM bicycle WHERE id = ?";
$stmt = $db->prepare("SELECT * FROM bicycle WHERE id = ?");
$stmt->bind_param('i', $productId);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();


// 上一个、下一个 画蛇添足

// 查询最小和最大ID
$rangeSql = "SELECT MIN(id) AS minId, MAX(id) AS maxId FROM bicycle";
$rangeResult = $db->query($rangeSql);
$range = $rangeResult->fetch_assoc();

$minId = $range['minId'];
$maxId = $range['maxId'];

// 计算下一个和上一个商品ID
$prevId = $productId > $minId ? $productId - 1 : null;
$nextId = $productId < $maxId ? $productId + 1 : null;


// 数组映射
$categories = ['0' => 'Road', '1' => 'Mountain'];
$colors = ['0' => 'Default', '1' => 'Red', '2' => 'Black'];
$hubs = ['0' => 'Default', '1' => 'Spoke', '2' => 'Solid'];

// 从数据库获取的产品信息后，使用数组映射转换
$product['category'] = $categories[$product['category']];
$product['color'] = $colors[$product['color']];
$product['hub'] = $hubs[$product['hub']];


// 关闭数据库连接
$db->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo htmlspecialchars($product['series']); ?> - Bicycle Details</title>
<link rel="stylesheet" href="styles413.css">
</head>
<body>

<div class="container">
    <div class="breadcrumb">
        Home > Details
    </div>
    <h1 class="title" id="productName"><?php echo htmlspecialchars($product['series']); ?> </h1>
    <div class="details">
        <div class="image-container">
          <img id="productImage" src="<?php echo htmlspecialchars($product['imgUrl']); ?>" alt="<?php echo htmlspecialchars($product['series']); ?>">

        </div>
        <div class="info">


            <span class="tag"><?php echo $product['customized'] ? 'Customized' : 'Standard'; ?></span>
            <!-- <h2><?php echo htmlspecialchars($product['series']); ?></h2> -->
            <div class="product-attributes">
                <div class="price" id="productPrice">$<?php echo number_format($product['price'], 2); ?></div>
                <div class="category" id="productCategory">Category: <?php echo htmlspecialchars($product['category']); ?></div>
                <div class="color" id="productColor">Color: <?php echo htmlspecialchars($product['color']); ?></div>
                <div class="hub" id="productHub">Hub: <?php echo htmlspecialchars($product['hub']); ?></div>
            </div><br>


            <div>
            <!-- Previous and Next Buttons -->
            <button class="button previous">Previous</button>
            <button class="button next">Next</button>
            </div>
        </div>
    </div>
</div>


<script>

document.addEventListener('DOMContentLoaded', function() {
    const container = document.querySelector('.image-container');
    const img = document.querySelector('.image-container img');
    const lens = document.createElement('div');
    lens.classList.add('magnifier-lens');
    container.appendChild(lens);

    // 监听鼠标移动事件
    container.addEventListener('mousemove', function(e) {
        const pos = getCursorPosition(e, container);
        const posX = pos.x - (lens.offsetWidth / 2);
        const posY = pos.y - (lens.offsetHeight / 2);

        // 限制镜头位置
        lens.style.left = `${Math.max(0, Math.min(container.offsetWidth - lens.offsetWidth, posX))}px`;
        lens.style.top = `${Math.max(0, Math.min(container.offsetHeight - lens.offsetHeight, posY))}px`;

        // 计算放大效果
        lens.style.backgroundImage = `url('${img.src}')`;
        const factor = 2; // 放大倍数
        const bgX = -posX * factor;
        const bgY = -posY * factor;
        lens.style.backgroundSize = `${img.width * factor}px ${img.height * factor}px`;
        lens.style.backgroundPosition = `${bgX}px ${bgY}px`;
        lens.style.backgroundRepeat = 'no-repeat';
    });

    // 鼠标离开时隐藏镜头
    container.addEventListener('mouseleave', function() {
        lens.style.backgroundImage = 'none';
    });

    // 获取鼠标相对于容器的位置
    function getCursorPosition(e, el) {
        const a = el.getBoundingClientRect();
        return {
            x: e.pageX - a.left - window.pageXOffset,
            y: e.pageY - a.top - window.pageYOffset
        };
    }
});


// ajax

// JavaScript中全局变量定义

let minId = <?php echo $minId; ?>;
let maxId = <?php echo $maxId; ?>;

document.addEventListener('DOMContentLoaded', function() {


    const categories = { '0': 'Road', '1': 'Mountain' };
    const colors = { '0': 'Default', '1': 'Red', '2': 'Black' };
    const hubs = { '0': 'Default', '1': 'Spoke', '2': 'Solid' };


    const prevButton = document.querySelector('.previous');
    const nextButton = document.querySelector('.next');
    let currentProductId = <?php echo $productId; ?>;

    function loadProductDetails(productId) {
        fetch(`getProductDetails.php?id=${productId}`)
            .then(response => response.json())
            .then(data => {
                if (!data || Object.keys(data).length === 0) {
                    throw new Error(`No data returned for product ID: ${productId}`);
                }
                updateProductDetails(data);
                currentProductId = productId; // Update only on successful data load
            })
            .catch(error => {
                console.error('Error loading the product details:', error);
            });
    }


    function updateProductDetails(data) {


        const category = categories[data.category] || 'No Category';
        const color = colors[data.color] || 'No Color';
        const hub = hubs[data.hub] || 'No Hub';

        const formatter = new Intl.NumberFormat('en-US', {
          style: 'currency',
          currency: 'USD',
        });

        const formattedPrice = formatter.format(data.price);
        document.getElementById('productPrice').textContent = formattedPrice;

        document.getElementById('productName').textContent = data.series || 'No Series Available';
        document.getElementById('productImage').src = data.imgUrl ? data.imgUrl : 'placeholder.jpg'; // Use a placeholder if no image URL
        //document.getElementById('productPrice').textContent = `$ ${parseFloat(data.price).toFixed(2)}`;
        document.getElementById('productCategory').textContent = 'Category: ' + category;
        document.getElementById('productColor').textContent = 'Color: '+ color;
        document.getElementById('productHub').textContent = 'Hub: ' + hub;
    }

    prevButton.addEventListener('click', function() {
        if (currentProductId > minId) {
            updateNavigation('prev');
        }
    });
    nextButton.addEventListener('click', function() {
        if (currentProductId < maxId) {
            updateNavigation('next');
        }
    });

    function updateNavigation(direction) {
        const increment = direction === 'next' ? 1 : -1;
        const newProductId = currentProductId + increment;
        console.log(`Trying to load product ID: ${newProductId}`);

        // Check if newProductId is within the valid range
        if (newProductId >= minId && newProductId <= maxId) {
            console.log(`Current product ID before fetch: ${currentProductId}`);
            loadProductDetails(newProductId);
            console.log(`Current product ID after fetch: ${currentProductId}`);
        } else {
            console.log(`Product ID ${newProductId} is out of bounds.`);
        }
    }

});


</script>

</body>
</html>
