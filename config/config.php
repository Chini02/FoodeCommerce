<?php
// 
if (!isset($_SERVER["HTTP_REFERER"])) {
    
    header("location: index.php");
    exit;
}
// 
try {
    // 
    $host   = "localhost";
    $dbname = "food";
    $user   = "root";
    $pssd   = "";
    // connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname;",$user,$pssd);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
}


?>