<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);

include 'conx.php';
$data;
$log;
$array = array();
$cant = 0;
header('Content-Type: application/json');

try {
    $query = $conn->prepare('SELECT * FROM medicamento');
    $query->execute();

    $data = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($data as &$item) {
        if (isset($item['fechaCad'])) {
            $fechaCaducidad = new DateTime($item['fechaCad']);
            $hoy = new DateTime();

            if ($fechaCaducidad < $hoy) {
                $item['estado'] = 'Caducado';
            } else {
                $item['estado'] = 'Vigente';
            }
        } else {
            // Si no hay fecha de caducidad, puedes asignar un valor por defecto
            $item['estado'] = 'sin fecha';
        }
    }
} catch (PDOException $e) {
    $log['error'] = 'No se pueden obtener alertas medicas.';
    echo json_encode($log, JSON_PRETTY_PRINT);
    exit();
}


foreach ($data as &$item) {
    $cant = $cant + $item['cantidad'];
}


if (!empty($data)) {
    foreach ($data as &$item) {
        if (!isset($array['caducado']['cantidad'])) {
            $array['caducado']['cantidad'] = 0;
        }
        if ($item['estado'] == 'Caducado') {
            $array['caducado']['cantidad']++;
            $array['caducado']['nombre'][] = $item['nombre'];
            $array['caducado']['fechaCad'][] = $item['fechaCad'];
        }
    }
    $array['caducado']['porcentaje'] =  ($array['caducado']['cantidad'] / $cant) * 100;


    foreach ($data as &$item) {
        if ((int)$item['cantidad'] <= 0) {
            if (!isset($array['stock']['cantidad'])) {
                $array['stock']['cantidad'] = 0;
            }
            $array['stock']['cantidad']++;
            $array['stock']['nombre'][] = $item['nombre'];
        }
    }
    $array['stock']['porcentaje'] =  ($array['stock']['cantidad'] / $cant) * 100;
}

echo json_encode($array, JSON_PRETTY_PRINT);
