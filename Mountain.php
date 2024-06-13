<?php
// order.php
session_start();
include 'navbar.php';
if (!isset($_SESSION['user_name'])) {
    header('Location: login.php');
    exit();
}

?>

<!DOCTYPE HTML>
<html>
<head>
<title>Mountain Bikes </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />

</head>


<body>

<!-- 商品展示界面 -->


<div class="main_bg">
    <div class="wrap">    
        <div class="main">
            
            <h2 class="style top">Mountain Bikes</h2>
            <div class="search">
            <input type="text" id="searchInput" placeholder="Search by series...">
            <button id="searchButton">Search</button>
            </div>
            <div id="imageContainer">
                
            </div>
        </div>
    </div>
</div>

<script>
fetch('Process.php') // 后端代码所在的文件名
    .then(response => response.json())
    .then(data => {
        const imageContainer = document.getElementById('imageContainer');
        let count = 0;
        let gridsContainer;

        data.forEach(image => {
            
            if (image.category === '0') {
                if (count % 3 === 0) {
                    gridsContainer = document.createElement('div');
                    gridsContainer.className = 'grids_of_3';
                    imageContainer.appendChild(gridsContainer);
                }

                const grid1 = document.createElement('div');
                grid1.className = 'grid1_of_3';
                
                // const imageLink = document.createElement('a');
                // imageLink.href = '413whm.php';
                const imageLink = document.createElement('a');
                imageLink.href = `413whm.php?id=${image.id}`;
                imageLink.addEventListener('click', function() {
                // 使用 AJAX 发送图片的 ID 到 413whm.php
                const xhr = new XMLHttpRequest();
                xhr.open('GET', `413whm.php?id=${image.id}`, true);
                xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                // 处理从413whm.php返回的响应
                console.log(xhr.responseText);
                }
                };
                xhr.send();
                });


                
                const img = document.createElement('img');
                img.src = image.imgUrl;
                img.alt = 'Image';
                img.style.width = '200px'; // 设置宽度为200像素
                img.style.height = '150px'; // 设置高度为150像素
                
                const priceDiv = document.createElement('div');
                priceDiv.className = 'price';
                
                const h4 = document.createElement('h4');
                h4.innerHTML = `${image.price}¥<span>${image.series}</span>`;
               
                
                priceDiv.appendChild(h4);
                imageLink.appendChild(img);
                imageLink.appendChild(priceDiv);
                grid1.appendChild(imageLink);
                gridsContainer.appendChild(grid1);
                imageLink.innerHTML += '<span class="b_btm"></span>'; // 添加<span class="b_btm"></span>到<a>的末尾

                count++;
            }
        });
        
        function searchImages() {
            const searchInput = document.getElementById('searchInput').value.toLowerCase();
        
            imageContainer.innerHTML = ''; // 清空之前的图片
            
            count = 0;
           
            data.forEach(image => {
            
            if (image.category === '0' && image.series.toLowerCase().includes(searchInput)) {
                if (count % 3 === 0) {
                    gridsContainer = document.createElement('div');
                    gridsContainer.className = 'grids_of_3';
                    imageContainer.appendChild(gridsContainer);
                }

                const grid1 = document.createElement('div');
                grid1.className = 'grid1_of_3';
                
                const imageLink = document.createElement('a');
                imageLink.href = `413whm.php?id=${image.id}`;
                imageLink.addEventListener('click', function() {
                // 使用 AJAX 发送图片的 ID 到 413whm.php
                const xhr = new XMLHttpRequest();
                xhr.open('GET', `413whm.php?id=${image.id}`, true);
                xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                // 处理从413whm.php返回的响应
                console.log(xhr.responseText);
                }
                };
                xhr.send();
                });
                
                const img = document.createElement('img');
                img.src = image.imgUrl;
                img.alt = 'Image';
                img.style.width = '200px'; // 设置宽度为200像素
                img.style.height = '150px'; // 设置高度为150像素
                
                const priceDiv = document.createElement('div');
                priceDiv.className = 'price';
                
                const h4 = document.createElement('h4');
                h4.innerHTML = `${image.price}¥<span>${image.series}</span>`;
               
                
                priceDiv.appendChild(h4);
                imageLink.appendChild(img);
                imageLink.appendChild(priceDiv);
                grid1.appendChild(imageLink);
                gridsContainer.appendChild(grid1);
                imageLink.innerHTML += '<span class="b_btm"></span>'; // 添加<span class="b_btm"></span>到<a>的末尾

                count++;
            }
        });
        }

        document.getElementById('searchButton').onclick = searchImages; // 添加点击事件监听器
    })
    .catch(error => {
        console.error('Error:', error);
    });


    

</script>


</body>
</html>