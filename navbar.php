<html>
<head>
<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
    <link rel="stylesheet" href="navbar.css">
</head>
<body>
    <div class="navbar">
        <a href="NewWheels.html" id = "HP" class="<?= $current_page == 'NewWheels.html' ? 'active' : '' ?>">Home</a>
        <a href="mountain.php" id = "MP"class="<?= $current_page == 'mountain.php' ? 'active' : '' ?>">Mountain Bikes</a>
        <a href="road.php" id="RP" class="<?= $current_page == 'road.php' ? 'active' : '' ?>">Road Bikes</a>
        <a href="choose_category.php" id = "CP" class="<?= $current_page == 'choose_category.php' ? 'active' : '' ?>">Customization</a>
        <a href="myorder.php" id="profileI" class="profile <?= $current_page == 'myorder.php' ? 'active' : '' ?>"><span class="icon"></span></a>
        <a href="search.php" class="<?= $current_page == 'search.php' ? 'active' : '' ?>"><span class="search"></span></a>
    </div>
</body>
</html>


