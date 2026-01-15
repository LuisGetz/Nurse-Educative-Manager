<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);

include 'conx.php';
header('Content-Type: application/json');

$log = array();

if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $cad = $_POST['cad'];
    $type = $_POST['type'];
    $cant = $_POST['cant'];

    if (!empty($name) && !empty($cad) && !empty($type) && !empty($cant)) {
        try {
            $query = $conn->prepare("INSERT INTO medicamento(id, nombre, cantidad, fechaCad, tipo) VALUES (null, :name, :cant, :cad, :type)");
            $query->bindParam(':name', $name);
            $query->bindParam(':cad', $cad);
            $query->bindParam(':type', $type);
            $query->bindParam(':cant', $cant);
            $query->execute();

            $log['log'] = 'Se guardo correctamente.';
            echo json_encode($log, JSON_PRETTY_PRINT);
        } catch (PDOException $e) {
            $log['error'] = 'Error en la consulta: ' . $e->getMessage();
            echo json_encode($log, JSON_PRETTY_PRINT);
        }
    } else {
        $log['error'] = "No se guardó: Campos vacios 1 ";
        echo json_encode($log, JSON_PRETTY_PRINT);
    }
}

if (isset($_GET['getdata'])) {
    try {
        $query = $conn->prepare("SELECT * FROM medicamento");
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
                $item['estado'] = 'sin fecha';
            }
        }
        echo json_encode($data, JSON_PRETTY_PRINT);
    } catch (PDOException $e) {
        $log['error'] = 'Error en la consulta: ' . $e->getMessage();
        echo json_encode($log, JSON_PRETTY_PRINT);
    }
}

if (isset($_GET['search'])) {
    $search = '%' . $_GET['search'] . '%';
    try {
        $query = $conn->prepare("SELECT * FROM `medicamento` WHERE id LIKE :search OR nombre LIKE :search");
        $query->bindParam(':search', $search);
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
                $item['estado'] = 'Sin fecha';
            }
        }

        echo json_encode($data, JSON_PRETTY_PRINT);
    } catch (PDOException $e) {
        $log['error'] = 'Error en la consulta: ' . $e->getMessage();
        echo json_encode($log, JSON_PRETTY_PRINT);
    }
}

if (isset($_POST['med-id'])) {
    $medid = $_POST['med-id'];
    $medname = $_POST['med-name'];
    $medcad = $_POST['med-cad'];
    $medtype = $_POST['med-type'];
    $medcant = $_POST['med-cant'];

    if (!empty($medid) && !empty($medname) && !empty($medcad) && !empty($medtype) && !empty($medcant)) {
        try {
            $query = $conn->prepare("UPDATE medicamento SET nombre=:name, cantidad=:cant, fechaCad=:cad, tipo=:type WHERE id=:id");
            $query->bindParam(":id", $medid);
            $query->bindParam(":name", $medname);
            $query->bindParam(":cad", $medcad);
            $query->bindParam(":type", $medtype);
            $query->bindParam(":cant", $medcant);
            $query->execute();

            $log['log'] = 'Se guardo correctamente.';
            echo json_encode($log, JSON_PRETTY_PRINT);
        } catch (PDOException $e) {
            $log['error'] = 'Error en la consulta: ' . $e->getMessage();
            echo json_encode($log, JSON_PRETTY_PRINT);
        }
    } else {
        $log['error'] = "No se guardó: Campos vacios.";
        echo json_encode($log, JSON_PRETTY_PRINT);
    }
}

if (isset($_GET['del'])) {
    try {
        $del = $_GET['del'];

        $query = $conn->prepare("DELETE FROM `medicamento` WHERE id=:id");
        $query->bindParam(":id", $del);
        $query->execute();

        $log['log'] = 'Se elimino correctamente.';
        echo json_encode($log, JSON_PRETTY_PRINT);
    } catch (PDOException $e) {
        $log['error'] = 'Error en la consulta: ' . $e->getMessage();
        echo json_encode($log, JSON_PRETTY_PRINT);
    }
}
