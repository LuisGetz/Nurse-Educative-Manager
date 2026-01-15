<?php 
$server="localhost";
$user="root";
$pass="";

try{
    $conn = new PDO("mysql:host=$server;dbname=enfcetis093;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo $e;
}
?>