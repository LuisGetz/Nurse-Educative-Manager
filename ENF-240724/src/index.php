<?php
session_start();

if(empty($_SESSION['username'])) {
    header('Location: ../');
    exit();
}else{
    header('Location: ../app.php');
    exit();
}