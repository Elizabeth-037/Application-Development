<?php
// customization.php
session_start();
include 'navbar.php';

if (!isset($_SESSION['user_name']) || !isset($_GET['category'])) {
    header('Location: login.php');
    exit();
}

$category = (int)$_GET['category'];
$seriesOptions = $category == 0 ? ['Breeze', 'Lightning'] : ['Flash', 'Spark'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customize Your Bicycle</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
    <style>
/* 应用于所有label标签的默认字体 */
.option label {
    font-family: 'Open Sans', sans-serif; /* 这里是您选择的默认字体 */
    margin-right: 10px;
}

/* 特别为Series的选项设置艺术字体 */
input[name="series"][value="Breeze"] + label {
    font-family: 'Roboto', sans-serif; /* 第一种艺术字体 */
}

input[name="series"][value="Lightning"] + label,
input[name="series"][value="Flash"] + label,
input[name="series"][value="Spark"] + label {
    font-family: 'Open Sans', sans-serif;
}

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            justify-content: center;
        }
        .customization-container {
            display: flex;
            flex-direction: column; 
            align-items: center; /、
            justify-content: center; 
            height: 50vh; 
            margin-top: 0; 
            align-items: center;
        }
        .bike-image {
            flex: 1;
            text-align: center;
        }
	.bike-image img {
    		width: auto;  
    		height: 296px; 
    		object-fit: cover;
	}
        .options-container {
            width: 100%; /* Full width */
            display: flex;
            flex-direction: column; /* Stack children vertically */
            align-items: center; /* Center form and its children */
        }
        .option {
            margin: 10px 0;
        }
        .option label {
            margin-right: 10px;
        }
        .submit-button {
    	    display: block;
            width: 20%; 
            padding: 10px;
    	    background-color: #5cb85c;
    	    color: white;
    	    border: none;
    	    border-radius: 4px;
    	    cursor: pointer;
    	    margin-top: 20px; 
            text-align: center; 
        }
	.color-option {
    		display: inline-block;
    		margin-right: 10px;
    		cursor: pointer;
	}

	.color-option input[type="radio"] {
    		display: none; 
	}

	.color-option span {
    		display: inline-block;
    		height: 30px; 
    		width: 30px; 
    		border-radius: 50%; 
		transition: background-color 0.3s; 
	}

	#red-color span {
    		background-color: red;
	}

	#black-color span {
    		background-color: black;
	}

	@keyframes blink {
    		50% {
        		opacity: 0.5;
    		}
	}

	.color-option input[type="radio"]:checked + span {
    		animation: blink 1s infinite; 
	}

   	</style>
</head>
<body>
    <div class="customization-container">
        <div class="bike-image">
            <img src="" alt="Custom Bike" id="bikeImg">
        </div>
        <div class="options-container">
            <form action="order.php" method="get" id="customForm">
                    <div class="option">
                    <strong>Series:</strong><br>
                    <?php foreach ($seriesOptions as $option): ?>
                    <label>
                        <input type="radio" name="series" value="<?= htmlspecialchars($option) ?>" required>
                        <?= htmlspecialchars($option) ?>
                    </label>
                    <?php endforeach; ?>
                </div>
		<div id="description"></div>
                <div class="option">
    			<strong>Color:</strong><br>
    			<label class="color-option" id="red-color">
        			<input type="radio" name="color" value="1" required>
       			 	<span></span>
    			</label>
    			<label class="color-option" id="black-color">
        			<input type="radio" name="color" value="2" required>
        			<span></span>
    			</label>
		</div>
                <div class="option">
                    <strong>Hub:</strong><br>
                    <!-- Placeholder for hub options. Replace with actual image tags and logic -->
                    <label>
                        <input type="radio" name="hub" value="1" required> Spoke
                    </label>
                    <label>
                        <input type="radio" name="hub" value="2" required> Solid
                    </label>
                </div>
    		<input type="hidden" name="id" id="id" value=>
                <input type="hidden" name="category" value="<?= $category ?>"
 id="categoryInput">
                <button type="submit" class="submit-button">Order Now</button>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Function to fetch and update the bike image
            function fetchBikeImage() {
                var series = $('input[name="series"]:checked').val();
                var color = $('input[name="color"]:checked').val();
                var hub = $('input[name="hub"]:checked').val();
                var category = $('#categoryInput').val();
                
                $.ajax({
                    url: 'fetch_bike_image.php', 
                    type: 'POST',
                    data: {
                        category: category,
                        series: series,
                        color: color,
                        hub: hub
                    },
                    success: function(data) {
                        $('#bikeImg').attr('src', data.imgUrl);
   			$('#description').text(data.description);
                        $('#id').val(data.id);
			console.log(data);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('AJAX error:', textStatus, errorThrown);
                    }
                });
            }

            $('input[name="series"][value="Breeze"]').prop('checked', true);
            $('input[name="series"][value="Flash"]').prop('checked', true);
            $('input[name="color"][value="1"]').prop('checked', true);
            $('input[name="hub"][value="1"]').prop('checked', true);
            fetchBikeImage();

            $('#customForm input').change(fetchBikeImage);
        });
    </script>
</body>
</html>