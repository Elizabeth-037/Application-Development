<?php
session_start();
include 'navbar.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Feedback</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            background-image: url("background.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        }

        .container {
            display: flex;
            align-items: flex-start;
            justify-content: center;
            flex-wrap: wrap;
        }

        .form-container {
    flex: 1;
    padding-right: 20px;
    margin-bottom: 20px;
    padding: 20px;
    border-radius: 8px;
    width: calc(33.33% - 20px);
    border: 6px solid rgb(255, 174, 182); /* 添加内部边框样式，颜色为粉色 */
}

    
        .image-container {
    flex: 1;
    display: flex;
    align-items: flex-start;
    justify-content: center;
    margin-right: 20px;
    margin-bottom: 20px;
    height: calc(105vh - 20px);
    border: none /* 添加内部边框样式，颜色为粉色 */
}

        .image-container label {
            display: block;
            margin-bottom: 0px;
        }

        #additional_description {
            height: 3em;
            border: 2px dashed rgb(255, 174, 182);
        }

        .image-preview {
            max-width: 100%;
            max-height: 100%;
        }

        .form-container h2 {
           font-size: 24px;
           background-color: black;
           text-align: center;
           color: rgb(255, 174, 182);
           text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
           border: 2px solid black;
           padding: 10px;
           margin-top: -15px; /* 负值将标题向上移动 */
           border-radius: 10px;
        }

        .form-container input[type="submit"] {
            background-color: black; /* 设置背景色为黑色 */
            font-size: 24px;
            display: block;
            margin: 0 auto;
            color: rgb(255, 174, 182);
            text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
        }

        #feedback_content,
        #additional_description {
            width: 100%;
            box-sizing: border-box;
        }

        #feedback_content {
            height: 16em;
            border: 2px dashed rgb(255, 174, 182);
            border-radius: 10px;
        }

        #order_number {
            border: 2px dashed rgb(255, 174, 182);
        }

        #contact_info {
            border: 2px dashed rgb(255, 174, 182);
        }

        #urgency {
            width: 100%;
        }

        table {
        border-width: 8px;
        border-style: solid;
        border-color: black;
        border-radius: 8px;
        width: 100%;
        margin: 0 auto;
        max-height: 70vh; /* 设置表格最大高度为视口高度的70% */
        table-layout: fixed; /* 固定表格布局 */
        border-radius: 10px;
    }

td {
    background-color: rgb(255, 174, 182);
    padding: 5px;
    width: 25%;
    height: auto;
    animation-name: imageZoom;
    animation-duration: 4s;
    animation-timing-function: linear;
    animation-iteration-count: infinite;
}


td:first-child {
    border: none; /* 取消第一列单元格的边框 */
}

td:nth-child(2) {
    height: inherit; /* 设置第二列单元格的高度与第一列相同 */
}

td img {
        max-width: 100%;
        max-height: 90%; /* 每个图片的最大高度为单元格高度的90% */
        object-fit: contain;
    }

.container:not(.form-container) {
    border: none; /* 取消边框 */
}

.container:not(.form-container) * {
    font-family: "Microsoft YaHei", sans-serif;
    font-weight: bold;
}

.table1 {
    border: none; /* 取消边框 */
}
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>User Feedback</h2>
            <form action="submit_feedback.php" method="post" enctype="multipart/form-data">
                <label for="order_number">OrderID: </label>
                <input type="text" id="order_number" name="order_number" required><br><br>

                <label for="contact_info">Contact: </label>
                <input type="text" id="contact_info" name="contact_info" required><br><br>

                <label for="feedback_type">Type </label>
                <select id="feedback_type" name="feedback_type" required>
                    <option value="">Choose a Type</option>
                    <option value="Product Issue">Product Issue</option>
                    <option value="Logistic Issue">Logistic Issue</option>
                    <option value="Customer Service Issue">Customer Service Issue</option>
                    <!-- 可根据需要添加其他选项 -->
                </select><br><br>

                <label for="feedback_content">Feedback Info:</label><br>
                <textarea id="feedback_content" name="feedback_content" rows="8" required></textarea><br><br>

                <label for="urgency">Emergency Degree:</label>
                <input type="range" id="urgency" name="urgency" min="1" max="4" required><br><br>

                <label for="satisfaction">Satisfaction:</label>
                <input type="radio" id="satisfaction_good" name="satisfaction" value="good" required>
                <label for="satisfaction_good">Good</label>
                <input type="radio" id="satisfaction_average" name="satisfaction" value="average" required>
                <label for="satisfaction_average">Average</label>
                <input type="radio" id="satisfaction_poor" name="satisfaction" value="poor" required>
                <label for="satisfaction_poor">Poor</label><br><br>

                <label for="additional_description">Supplimental Description:</label><br>
                <textarea id="additional_description" name="additional_description" rows="3"></textarea><br><br>

                <label for="image">Upload Image:</label>
                <input type="file" id="image" name="image"><br><br>

                <input type="submit" value="Submit">
            </form>
        </div>
        <div class="image-container">
    <table class="table1"></table>
    <table>
        <tr>
            <td><img src="breeze.jpg" alt="breeze"></td>
        </tr>
        <tr>
            <td><img src="lighting.jpg" alt="lighting"></td>
        </tr>
        <tr>
            <td><img src="flash.jpg" alt="flash"></td>
        </tr>
        <tr>
            <td><img src="spark.jpg" alt="spark"></td>
        </tr>
    </table>
</div>
    </div>
</body>
</html>