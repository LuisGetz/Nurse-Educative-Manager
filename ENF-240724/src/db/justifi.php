<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);

include 'conx.php';
header('Content-Type: application/json');

$log = array();

function dateFormat($fecha){
    $fechaR = $fecha;
    $timestamp = strtotime($fechaR);
    $format = new IntlDateFormatter('es_ES', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
    $date = $format->format($timestamp);
    return $date;
}

if (isset($_POST['txtJustQR'])) {
    $id = $_POST['txtJustQR'];

    if (!empty($id)) {
        try {
            $query = $conn->prepare("SELECT
                                            alumnos.numimss AS numimss,
                                            alumnos.nombre AS name,
                                            grupos.nombre AS grupo
                                        FROM
                                            alumnos
                                        INNER JOIN grupos ON grupos.id = alumnos.grupo
                                        WHERE
                                            alumnos.numimss = :id");
            $query->bindParam(':id', $id);
            $query->execute();
        } catch (PDOException $e) {
            $log['error'] = "Error en la consulta. " . $e;
            echo json_encode($log, JSON_PRETTY_PRINT);
        }
        $data = $query->fetch(PDO::FETCH_ASSOC);
        echo json_encode($data, JSON_PRETTY_PRINT);
    } else {
        $log['error'] = "No se guardó: Campos vacios";
        echo json_encode($log, JSON_PRETTY_PRINT);
    }
} else if (isset($_POST['nombre'])) {
    $nombre = $_POST['nombre'];
    $gp = $_POST['gp'];
    $datestart = $_POST['datestart'];
    $dateend = (!empty($_POST['dateend'])) ? " a {$_POST['dateend']}" : "";
    $hourstart = $_POST['hourstart'];
    $hourend = $_POST['hourend'];
    $mot = $_POST['mot'];
    $det = $_POST['det'];
    $firma = $_POST['firma'];
    $emitDate = dateFormat(date('Y-m-d'));

    if (!empty($nombre) && !empty($gp) && !empty($datestart) && !empty($hourstart) && !empty($hourend) && !empty($mot)) {
        $nombreUrl = urlencode($nombre);
        $gpUrl = urlencode($gp);
        $datestartUrl = urlencode($datestart);
        $dateendUrl = urlencode($dateend);
        $hourstartUrl = urlencode($hourstart);
        $hourendUrl = urlencode($hourend);
        $motUrl = urlencode($mot);
        $detUrl = urlencode($det);
        $firmaUrl = urlencode($firma);
        $emitDateUrl = urlencode($emitDate);

        $log['message'] = "name=$nombreUrl&gp=$gpUrl&fecin=$datestartUrl&fecfin=$dateendUrl&horaini=$hourstartUrl&horafin=$hourendUrl&mot=$motUrl&det=$detUrl&firma=$firmaUrl&emitDate=$emitDateUrl";
        echo json_encode($log, JSON_PRETTY_PRINT);
    } else {
        $log['error'] = "No se guardó: Campos vacios";
        echo json_encode($log, JSON_PRETTY_PRINT);
    }
} else if (isset($_GET['docente'])) {
    try {
        $query = $conn->prepare('SELECT * FROM docentes');
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data, JSON_PRETTY_PRINT);
    } catch (PDOException $e) {
        $log['error'] = "Error en la consulta. " . $e;
        echo json_encode($log, JSON_PRETTY_PRINT);
    }
} else if (isset($_GET['getdata'])) {
    try {
        $query = $conn->prepare('SELECT 
                                    justificantes.id as id,
                                    alumnos.nombre as alumno,
                                    justificantes.link as link,
                                    justificantes.fecha as fecha
                                FROM
                                    justificantes
                                INNER JOIN alumnos on alumnos.numimss = justificantes.alumno
                                ORDER BY fecha DESC');
        $query->execute();

        $data = json_encode($query->fetchAll(PDO::FETCH_ASSOC));
        echo $data;
    } catch (PDOException $e) {
        $log['error'] = "Error en la consulta. " . $e;
        echo json_encode($log, JSON_PRETTY_PRINT);
    }
} else if (isset($_GET['num'])) {
    try {
        $id = $_GET['num'];
        $query = $conn->prepare('SELECT * FROM `justificantes` WHERE id = :id');
        $query->bindParam(':id', $id);
        $query->execute();

        $data = json_encode($query->fetch(PDO::FETCH_ASSOC));
        echo $data;
    } catch (PDOException $e) {
        $log['error'] = "Error en la consulta. " . $e;
        echo json_encode($log, JSON_PRETTY_PRINT);
    }
} else if (isset($_GET['search'])) {
    $search = '%' . $_GET['search'] . '%';
    try {
        $query = $conn->prepare('
            SELECT
                justificantes.id AS id,
                alumnos.nombre AS nombre,
                justificantes.link AS link,
                justificantes.fecha AS fecha,
                grupos.nombre AS grupo
            FROM
                justificantes
            INNER JOIN alumnos ON alumnos.numimss = justificantes.alumno
            INNER JOIN grupos ON grupos.id = alumnos.grupo
            WHERE
                alumnos.nombre LIKE :search OR
                justificantes.id LIKE :search OR justificantes.alumno LIKE :search OR DATE(justificantes.fecha) LIKE :search OR grupos.nombre LIKE :search');
        $query->bindParam(':search', $search);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data, JSON_PRETTY_PRINT);
    } catch (PDOException $e) {
        $log['error'] = "Error en la consulta. " . $e;
        echo json_encode($log, JSON_PRETTY_PRINT);
    }
}
