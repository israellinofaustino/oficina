<?php
require_once("config.php");
date_default_timezone_set('Europe/London');
$db = parse_url(getenv("postgres://rmlnlaizxnvoly:36d89b7cb1739a10c4f4545ec22d883818ba48cca9d04935e2864626e9484354@ec2-54-247-137-184.eu-west-1.compute.amazonaws.com:5432/d641e6ul1sj6e2"));
try{
    $pdo = new PDO("pgsql:" . sprintf("host=ec2-54-247-137-184.eu-west-1.compute.amazonaws.com;port=5432;user=rmlnlaizxnvoly;password=36d89b7cb1739a10c4f4545ec22d883818ba48cca9d04935e2864626e9484354;dbname=d641e6ul1sj6e2",
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