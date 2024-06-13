<?php
// order.php
session_start();
include 'navbar.php';
if (!isset($_SESSION['user_name'])) {
    header('Location: login.php');
    exit();
}

if (!isset($_GET['id'])) {
    exit('No bicycle selected.');
}

$user = 'root';
$password = '';
$server = '127.0.0.1';
$database = 'project';
$pdo = new PDO("mysql:host=$server;dbname=$database", $user, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $pdo->prepare("SELECT * FROM bicycle WHERE id = ?");
$stmt->execute([$_GET['id']]);
$bicycle = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$bicycle) {
    exit('Bicycle not found.');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Place Your Order</title>
    <style>
	h2 {
	    text-align: center
	}
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .order-form-container {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px;
            width: 100%;
            max-width: 600px;
        }
        .order-details {
            margin-bottom: 20px;
        }
	.order-details img {
    	    display: block; 
    	    max-width: 100%; 
   	    height: auto; 
    	    margin: 0 auto;
    	    border-radius: 4px; 
	}
        .form-group {
            margin-bottom: 10px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="number"],
        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .order-button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }
        .order-button:hover {
            background-color: #4cae4c;
        }
    </style>
    <script>
    function updateTotalPrice() {
        var price = <?php echo json_encode($bicycle['price']); ?>;
        var quantity = document.getElementById('quantity').value;
        document.getElementById('totalPrice').value = price * quantity;
    }
    function updateTotalPrice() {
        var price = <?php echo json_encode($bicycle['price']); ?>;
        var quantity = document.getElementById('quantity').value;
        document.getElementById('totalPrice').value = price * quantity;
    }

    function validatePhoneNumber() {
        var phoneInput = document.getElementById('phone');
        var countryCode = document.getElementById('countryCode').value;
        var regex = countryCode === '+86' ? /^\d{11}$/ : /^\d{8}$/;
        
        if (!regex.test(phoneInput.value)) {
            alert('Invalid phone number for selected country.');
            phoneInput.focus();
            return false;
        }
        return true;
    }
    </script>
</head>
<body>
    <div class="order-form-container">
        <h2>Order Details</h2>
        <div class="order-details">
            <form action="submit_order.php" method="post" onsubmit="return validatePhoneNumber()>
                <img src="<?php echo htmlspecialchars($bicycle['imgUrl']); ?>" alt="Bicycle">
                <div class="form-group">
                    <p>Series: <strong><?php echo htmlspecialchars($bicycle['series']); ?></strong></p>
                    <p>Type: <strong></strong><?php echo $bicycle['customized'] == 0 ? 'Non-customized Bicycle' : 'Customized Bicycle'; ?></p>
                    <p>Price: $<span id="bikePrice"><?php echo htmlspecialchars($bicycle['price']); ?></span></p>
                </div>

                <div class="form-group">
                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" value="1" min="1" onchange="updateTotalPrice()">
                </div>
                <div class="form-group">
                    <label>Total Price:</label>
                    <input type="text" id="totalPrice" name="totalPrice" value="<?php echo htmlspecialchars($bicycle['price']); ?>" readonly>
                </div>
                <h3>Delivery Details</h3>
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="countryCode">Country Code:</label>
                    <select id="countryCode" name="countryCode">
                        <option value="+86">+86, Mainland China</option>
                        <option value="+852">+852, Hong Kong, China</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="text" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <textarea id="address" name="address" required></textarea>
                </div>
                <input type="hidden" name="userId" value="<?php echo $_SESSION['user_id']; ?>">
                <input type="hidden" name="bicycleId" value="<?php echo htmlspecialchars($bicycle['id']); ?>">
                <button type="submit" class="order-button">Place Order</button>
            </form>
        </div>
    </div>
</body>
</html>
