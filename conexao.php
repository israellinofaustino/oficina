<?php
require_once("config.php");
date_default_timezone_set('Europe/London');
$db = parse_url(getenv("postgres://exnsqayubcquva:18c853276acedc59be44deea3bbf24ddece34e943f862e68d188c84f87e18b1e@ec2-176-34-105-15.eu-west-1.compute.amazonaws.com:5432/d746d39isninal"));
try{
    $pdo = new PDO("pgsql:" . sprintf("host=ec2-176-34-105-15.eu-west-1.compute.amazonaws.com;port=5432;user=exnsqayubcquva;password=18c853276acedc59be44deea3bbf24ddece34e943f862e68d188c84f87e18b1e;dbname=d746d39isninal",
        // $db["host"],
        // $db["port"],
        // $db["user"],
        // $db["pass"],
        ltrim($db["path"], "/")
    ));
    
}catch(Exception $e){
        echo "Error connecting to database <br>" . $e;
}

// connection localhost using XAMPP
// try{
//     $pdo = new PDO("pgsql:host=$servidor;dbname=$banco", "$usuario", "$senha");
// }catch(Exception $e){
//     echo "Error connecting to database <br>" . $e;
// }

?>