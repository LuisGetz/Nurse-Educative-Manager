<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);

include 'conx.php';
header('Content-Type: application/json');

$log = array();

if (isset($_GET['getdata'])) {
    try {
        $query = $conn->prepare("(
                                SELECT
                                    histcon.id AS id,
                                    alumnos.nombre AS nombre,
                                    grupos.nombre AS grupo,
                                    histcon.sintomas AS sintomas,
                                    medicamento.nombre AS medic_name,
                                    histcon.cantidad AS cant,
                                    histcon.fechaHora AS fecha
                                FROM
                                    histcon
                                INNER JOIN alumnos ON histcon.alumno = alumnos.numimss
                                INNER JOIN grupos ON grupos.id = alumnos.grupo
                                INNER JOIN medicamento ON histcon.medic = medicamento.id
                            )
                            UNION
                                (
                                SELECT
                                    histcon.id AS id,
                                    docentes.nombre AS nombre,
                                    grupos.nombre AS grupo,
                                    histcon.sintomas AS sintomas,
                                    medicamento.nombre AS medic_name,
                                    histcon.cantidad AS cant,
                                    histcon.fechaHora AS fecha
                                FROM
                                    histcon
                                INNER JOIN docentes ON histcon.alumno = docentes.numimss
                                INNER JOIN grupos ON grupos.id = docentes.grupo
                                INNER JOIN medicamento ON histcon.medic = medicamento.id
                            ) ORDER BY fecha DESC
        ");
        $query->execute();

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data, JSON_PRETTY_PRINT);
    } catch (PDOException $e) {
        $log['error'] = 'Fallo de consulta. ';
        echo json_encode($log, JSON_PRETTY_PRINT);
    }
} else if (isset($_GET['search'])) {
    $search = '%' . $_GET['search'] . '%';
    $search2 = $_GET['search'];
    try {
        $query = $conn->prepare("(
                                SELECT
                                    histcon.id AS id,
                                    alumnos.nombre AS nombre,
                                    grupos.nombre AS grupo,
                                    histcon.sintomas AS sintomas,
                                    medicamento.nombre AS medic_name,
                                    histcon.cantidad AS cant,
                                    histcon.fechaHora AS fecha
                                FROM
                                    histcon
                                INNER JOIN alumnos ON histcon.alumno = alumnos.numimss
                                INNER JOIN grupos ON grupos.id = alumnos.grupo
                                INNER JOIN medicamento ON histcon.medic = medicamento.id
                                WHERE
                                    alumnos.nombre LIKE :search OR
                                    histcon.alumno LIKE :search OR
                                    grupos.nombre LIKE :search OR
                                    DATE(histcon.fechaHora) LIKE :search
                            )
                            UNION
                                (
                                SELECT
                                    histcon.id AS id,
                                    docentes.nombre AS nombre,
                                    grupos.nombre AS grupo,
                                    histcon.sintomas AS sintomas,
                                    medicamento.nombre AS medic_name,
                                    histcon.cantidad AS cant,
                                    histcon.fechaHora AS fecha
                                FROM
                                    histcon
                                INNER JOIN docentes ON histcon.alumno = docentes.numimss
                                INNER JOIN grupos ON grupos.id = docentes.grupo
                                INNER JOIN medicamento ON histcon.medic = medicamento.id
                                WHERE
                                    docentes.nombre LIKE :search OR
                                    histcon.alumno LIKE :search OR
                                    grupos.nombre LIKE :search OR
                                    histcon.fechaHora LIKE :search
                            )
        ");
        $query->bindParam(':search', $search);
        $query->bindParam(':search2', $search2);
        $query->execute();

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data, JSON_PRETTY_PRINT);
    } catch (PDOException $e) {
        $log['error'] = 'Fallo de consulta. ' . $e->getMessage();
        echo json_encode($log, JSON_PRETTY_PRINT);
    }
} else if (isset($_GET['cons'])) {
    $cons = $_GET['cons'];
    try {
        $query = $conn->prepare("SELECT * FROM histcon WHERE id=:id");
        $query->bindParam(':id', $cons);
        $query->execute();

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data, JSON_PRETTY_PRINT);
    } catch (PDOException $e) {
        $log['error'] = 'Fallo de consulta. ';
        echo json_encode($log, JSON_PRETTY_PRINT);
    }
} else if (isset($_GET['allmedic'])) {
    $query = $conn->prepare("SELECT * FROM medicamento");
    $query->execute();

    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data, JSON_PRETTY_PRINT);
} else if (isset($_GET['del'])) {
    $delid = $_GET['del'];
    $numi = $_GET['num'];

    try {
        $conn->beginTransaction();

        $queryUser = $conn->prepare("SELECT
                                    'docentes' AS tipo,
                                    docentes.sexo AS sexo
                                FROM
                                    docentes
                                WHERE
                                    numimss = :num
    
                                UNION
    
                                SELECT
                                    'alumnos' AS tipo,
                                    alumnos.sexo AS sexo
                                FROM
                                    alumnos
                                WHERE
                                    numimss = :num");
        $queryUser->bindParam(':num', $numi);
        $queryUser->execute();

        $option = $queryUser->fetch(PDO::FETCH_ASSOC);

        $querymed = $conn->prepare("SELECT * FROM histcon WHERE id=:id");
        $querymed->bindParam(':id', $delid);
        $querymed->execute();

        $delmed = $querymed->fetch(PDO::FETCH_ASSOC);

        $queryDel = $conn->prepare("DELETE FROM histcon WHERE id=:id");
        $queryDel->bindParam(':id', $delid);
        $queryDel->execute();

        $queryMedicAdd = $conn->prepare("UPDATE medicamento SET cantidad = cantidad + :cant WHERE id = :id");
        $queryMedicAdd->bindParam(':cant', $delmed['cantidad']);
        $queryMedicAdd->bindParam(':id', $delmed['medic']);
        $queryMedicAdd->execute();

        if ($option['tipo'] == "docentes") {
            if ($option['sexo'] == 'Masculino') {
                $query = $conn->prepare("UPDATE stats SET hombres = hombres - 1 WHERE id = 1");
                $query->execute();
            } else if ($option['sexo'] == 'Femenino') {
                $query = $conn->prepare("UPDATE stats SET mujeres = mujeres - 1 WHERE id = 1");
                $query->execute();
            }
        } else if ($option['tipo'] == 'alumnos') {
            if ($option['sexo'] == 'Masculino') {
                $query = $conn->prepare("UPDATE stats SET hombres = hombres - 1 WHERE id = 2");
                $query->execute();
            } else if ($option['sexo'] == 'Femenino') {
                $query = $conn->prepare("UPDATE stats SET mujeres = mujeres - 1 WHERE id = 2");
                $query->execute();
            }
        }

        $conn->commit();
        $log['log'] = 'Se guardo.';
        echo json_encode($log, JSON_PRETTY_PRINT);
    } catch (PDOException $e) {
        $conn->rollBack();
        $log['error'] = 'Fallo de consulta. ' . $e->getMessage();
        echo json_encode($log, JSON_PRETTY_PRINT);
    }
} else if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sint = $_POST['sint'];
    $med = $_POST['med'];
    $cant = intval($_POST['cant']);
    $datetime = $_POST['datetime'];

    try {
        $conn->beginTransaction();

        $query1 = $conn->prepare("SELECT * FROM `histcon` WHERE id=:id");
        $query1->bindParam(":id", $id);
        $query1->execute();
        $data1 = $query1->fetch(PDO::FETCH_ASSOC);
        $cantint1 = intval($data1['cantidad']);

        $query2 = $conn->prepare("SELECT * FROM `medicamento` WHERE id=:id");
        $query2->bindParam(":id", $data1['medic']);
        $query2->execute();
        $data2 = $query2->fetch(PDO::FETCH_ASSOC);
        $cantint2 = intval($data2['cantidad']);

        $query3 = $conn->prepare("UPDATE histcon SET cantidad = :cant WHERE id=:id");
        $query3->bindParam(':id', $id);
        $query3->bindParam(':cant', $cant);
        $query3->execute();

        if ($cant < $cantint2) {
            $res = $cantint2 + $cantint1 - $cant;
            $query4 = $conn->prepare("UPDATE medicamento SET cantidad = :cantint WHERE id=:idmed");
            $query4->bindParam(":idmed", $data1['medic']);
            $query4->bindParam(":cantint", $res);
            $query4->execute();

            $conn->commit();
            $log['log'] = 'Se guardo.';
            echo json_encode($log, JSON_PRETTY_PRINT);
        }else{
            $conn->rollBack();
            $log['warning'] = 'Cantidades invalidas.';
            echo json_encode($log, JSON_PRETTY_PRINT);
        }

    } catch (PDOException $e) {
        $conn->rollBack();
        $log['error'] = 'Fallo de consulta. ' . $e->getMessage();
        echo json_encode($log, JSON_PRETTY_PRINT);
    }
}
