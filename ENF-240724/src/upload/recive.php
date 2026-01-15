<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);

include 'conx.php';
header('Content-Type: application/json');

$log = array();

if ($_FILES['pdf']) {
    $uploadDir = '';
    $uploadFile = $uploadDir . basename($_FILES['pdf']['name']);

    if (move_uploaded_file($_FILES['pdf']['tmp_name'], $uploadFile)) {
        echo json_encode(['message' => 'El archivo PDF se guardó correctamente']);
    } else {
        echo json_encode(['message' => 'Error al guardar el archivo']);
    }
} else {
    echo json_encode(['message' => 'No se envió ningún archivo']);
}
