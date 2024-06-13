<?php
session_start();
include 'navbar.php';
if (!isset($_SESSION['user_name'])) {
    header('Location: login.php');
    exit();
}
$user = 'root';
$password = '';
$server = '127.0.0.1';
$database = 'project';
$pdo = new PDO("mysql:host=$server;dbname=$database", $user, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$search_results = [];
if (isset($_GET['search'])) {
    $series = $_GET['search'];
    $stmt = $pdo->prepare("SELECT * FROM bicycle WHERE series LIKE ? AND customized = 0");
    $stmt->execute(["%$series%"]);
    $search_results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $stmt = $pdo->prepare("SELECT * FROM bicycle WHERE customized = 0 ORDER BY RAND() LIMIT 8");
    $stmt->execute();
    $search_results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Bicycles</title>
    <link rel="stylesheet" href="search.css">
    <script>
        function blurPage(){
            pageContent.classList.add("blur");
            document.body.classList.add("changeB");
        }
        function resetPage(){
            pageContent.classList.remove("blur");
            document.body.classList.remove("changeB");
        }
        function refreshPage(){
            location.reload();
        }
    </script>

</head>
<body>
<div class="search-form">
    <form id = "searchBar" action="search.php" method="get">
        <p id = "intro">Find A Bike</p>
        <input type="text" id="searchInput" name="search" placeholder="Search by types or series" onfocus="blurPage()" onblur="resetPage()"
               value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" required>
        
        <table>
            <tr>
                <th><input id = "refreshButtom"type="button" value="REFRESH" onclick="refreshPage()"></th>
                <th><input id = "submitButton" type="submit" value="SEARCH"></th>
            </tr>
        </table>
    </form>
    <?php if (!isset($_GET['search'])): ?>
        
    <?php endif; ?>
</div>
<br>
<div id = "divB">
    <?php if (!empty($search_results)): ?>
	<div class="search-container" id = "pageContent">
        <?php foreach ($search_results as $bike): ?>
            <div class="bike-item">
		        <a href="no_cus_bicycle_detail.php?id=<?php echo htmlspecialchars($bike['id']); ?>">
                    <img src="<?php echo htmlspecialchars($bike['imgUrl']); ?>" alt="<?php echo htmlspecialchars($bike['series']); ?>">
                    <h2><?php echo htmlspecialchars($bike['series']); ?></h2>
		        </a>
            </div>
        <?php endforeach; ?>
	</div>
    <?php endif; ?>
</div>
</body>
</html>
