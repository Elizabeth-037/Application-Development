<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <?php 
        include "navbar.php";
    ?>

<hr />

<hr id="ph"/>

    <div id = "content" class="main_content">
        <img src="http://localhost/logo.png" id="logo">
        <h2>NWS ID</h2><br>
        <p id = "intro">To Customize Your Bikes</p>
        <form action="login_process.php" method="post">
            <input type="email" name="email" id = "userE" class = "userInput" required placeholder="name@example.com"><br>
            <input type="password" name="password" id = "userP" class = "userInput" required placeholder="Password"><br>
            <input type="submit" id = "loginB" value="LOGIN">
        </form>
    </div>
</body>
</html>
