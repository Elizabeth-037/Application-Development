<?php
$user='root';
$password='';
$server='127.0.0.1';
$database='project';
$pdo=new PDO("mysql:host=$server;dbname=$database",$user,$password);
$color = $_GET['cl'];
var_dump($color);
// $color = 1;
if(is_int($color)===1){
    $sql = "SELECT imgUrl FROM bicycle WHERE color=1";
    $result = $pdo->query($sql);
    $columnCount = $result->columnCount();
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $imgUrl = $row['imgUrl']?$row['imgUrl']:null;
    $response = json_encode([
        'columnCount' => $columnCount,
        'imgUrl' => $imgUrl
    ]);
    header("Content-Type: application/json");
    echo $response;
    }
$pdo = null;
?>