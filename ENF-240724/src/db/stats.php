<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);

include 'conx.php';
header('Content-Type: application/json');

$log = array();

if(isset($_GET['getstats'])){
    $query=$conn->prepare("SELECT * FROM stats");
    $query->execute();

    $data=$query->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data, JSON_PRETTY_PRINT);
}