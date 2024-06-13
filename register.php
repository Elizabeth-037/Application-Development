<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>register</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <?php
        include "navbar.php";
    ?>
    <hr />
    <hr id="ph"/>
    <div id="content" class="main_content">
        <img src="http://localhost/logo.png" id="logo">
        <h2>Create Your NWS ID</h2><br>
        <p id ="intro"> Start Your Customization Journey</p>
        <form action="register_process.php" method="post">
            <input type="text" name="name" required id = "userN" placeholder = "User Name" class = "userInput"><br>
            <input type="email" name="email" required id = "userE" placeholder = "name@example.com" class = "userInput"><br>
            <input type="password" name="password" required id = "userP" placeholder = "Password" class = "userInput"><br>
            <input type="submit" value="RIGISTER" id = "registerB">
        </form>
    </div>
</body>
</html>
