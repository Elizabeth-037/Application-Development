<?php
// choose_category.php
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
    <meta charset="UTF-8">
    <title>Choose Your Category</title>
    <style>
        body {
            text-align: center;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .header-text {
            margin-top: 80px; /* Adjust this value as needed for your layout */
            font-size: 2em;
        }
        .categories-container {
            display: flex; /* Use flexbox to align items horizontally */
            justify-content: space-around; /* Distribute space around items */
            padding: 50px; /* Add some padding around the flex container */
        }
        .category-card {
            width: 40%; /* Set the width for the card */
            margin: 20px;
            transition: transform 0.3s ease; /* Animate the transform property */
            text-align: center; /* Align the text to the center */
            border-radius: 10px; /* Optional: Rounded corners for aesthetics */
            box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Optional: Add some shadow for depth */
        }
        .category-card:hover {
            transform: scale(0.95); /* Scale down the card when hovered */
            cursor: pointer;
        }
        .category-image {
            width: 100%; /* Let the image take the full width of the .category-card */
            border-top-left-radius: 10px; /* Optional: match the border-radius */
            border-top-right-radius: 10px; /* Optional: match the border-radius */
        }
        .category-label {
            display: block;
            padding: 10px; /* Add some padding to the label */
            background-color: #f7f7f7; /* Optional: a different background color for the label */
            border-bottom-left-radius: 10px; /* Optional: match the border-radius */
            border-bottom-right-radius: 10px; /* Optional: match the border-radius */
        }
    </style>
</head>
<body>
    <div class="header-text">Choose your category</div>
    <div class="categories-container">
        <div class="category-card" onclick="window.location.href='customization.php?category=1';">
            <img src="https://28goods.com/cdn/shop/articles/8.webp?v=1711834750&width=900" alt="Mountain" class="category-image">
            <span class="category-label">Mountain</span>
        </div>
        <div class="category-card" onclick="window.location.href='customization.php?category=0';">
            <img src="https://28goods.com/cdn/shop/articles/ezgif-1-963a9791d3.webp?v=1709348748&width=900" alt="Road" class="category-image">
            <span class="category-label">Road</span>
        </div>
    </div>
</body>
</html>
