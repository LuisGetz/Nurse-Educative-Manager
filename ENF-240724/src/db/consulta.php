<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);

include 'conx.php';
header('Content-Type: application/json');

$log = array();

if (isset($_POST['txt-con-imss-id'])) {
    $imss = $_POST['txt-con-imss-id'];
    if (!empty($imss)) {
        try {
            $query = $conn->prepare("(
                                        SELECT
                                            alumnos.numimss AS imss,
                                            alumnos.nombre AS name,
                                            alumnos.edad AS age,
                                            alumnos.sexo AS sexo,
                                            alumnos.grupo AS gp,
                                            alumnos.alergias AS alerg,
                                            grupos.nombre as grupoN
                                        FROM
                                            alumnos
                                        INNER JOIN grupos ON grupos.id = alumnos.grupo
                                        WHERE alumnos.numimss = :id
                                    )
                                    UNION
                                        (
                                        SELECT
                                            docentes.numimss AS imss,
                                            docentes.nombre AS name,
                                            docentes.edad AS age,
                                            docentes.sexo As sexo,
                                            docentes.grupo AS gp,
                                            docentes.alergias AS alerg,
                                            grupos.nombre as grupoN
                                        FROM
                                            docentes
                                        INNER JOIN grupos ON grupos.id = docentes.grupo
                                        WHERE docentes.numimss = :id
                                    )");
            $query->bindParam(':id', $imss);
            $query->execute();

            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($data, JSON_PRETTY_PRINT);
        } catch (PDOException $e) {
            $log['error'] = 'Fallo la consulta: ' . $e->getMessage();
            echo json_encode($log, JSON_PRETTY_PRINT);
        }
    } else {
        $log['error'] = 'Campos vacios';
        echo json_encode($log, JSON_PRETTY_PRINT);
    }
} else if (isset($_GET['med'])) {
    $query = $conn->prepare('SELECT * FROM medicamento');
    $query->execute();

    $data = [];
    $data2 = $query->fetchAll(PDO::FETCH_ASSOC);
    $hoy = new DateTime();

    foreach ($data2 as $row) {
        $fechaCaducidad = new DateTime($row['fechaCad']);
        $cant2 = intval($row['cantidad']);

        if ($row['cantidad'] > 0 && $fechaCaducidad > $hoy) {
            $data[] = $row;
        }
    }

    echo json_encode($data, JSON_PRETTY_PRINT);
} else if (isset($_POST['imss'])) {
    $imss = $_POST['imss'];
    $gp = $_POST['gp'];
    $sexo = $_POST['sexo'];
    $sint = $_POST['sint'];
    $casa = $_POST['casa'] ?? '0';
    $med = $_POST['med'];
    $cant = $_POST['cant'];
    $datetime = $_POST['datetime'];

    $day = date('l');

    if (!empty($imss) && !empty($gp) && !empty($sexo) && !empty($sint) && !empty($med) && !empty($cant) && !empty($datetime)) {
        try {
            $conn->beginTransaction();

            //consulta 1
            if ($gp == "Docentes") {
                $query = $conn->prepare("INSERT INTO histcon(id, alumno, sintomas, casa, medic, cantidad, fechaHora) VALUES (null, :imss, :sint, :casa, :med, :cant, :datetime)");
                $query->bindParam(":imss", $imss);
                $query->bindParam(":sint", $sint);
                $query->bindParam(":casa", $casa, PDO::PARAM_INT);
                $query->bindParam(":med", $med);
                $query->bindParam(":cant", $cant);
                $query->bindParam(":datetime", $datetime);
                $query->execute();
            } else {
                $query = $conn->prepare("INSERT INTO histcon(id, alumno, sintomas, casa, medic, cantidad, fechaHora) VALUES (null, :imss, :sint, :casa, :med, :cant, :datetime)");
                $query->bindParam(":imss", $imss);
                $query->bindParam(":sint", $sint);
                $query->bindParam(":casa", $casa, PDO::PARAM_INT);
                $query->bindParam(":med", $med);
                $query->bindParam(":cant", $cant);
                $query->bindParam(":datetime", $datetime);
                $query->execute();
            }

            //consulta 2
            $query2 = $conn->prepare("UPDATE medicamento SET cantidad= cantidad - :cant WHERE id = :id");
            $query2->bindParam(":id", $med);
            $query2->bindParam(":cant", $cant);
            $query2->execute();

            //consulta 3
            if ($gp == "Docente") {
                if ($sexo == "Femenino") {
                    $query3 = $conn->prepare("UPDATE `stats` SET mujeres = mujeres + 1 WHERE id = 1");
                    $query3->execute();
                } else {
                    $query3 = $conn->prepare("UPDATE `stats` SET hombres = hombres + 1 WHERE id = 1");
                    $query3->execute();
                }
            } else {
                if ($sexo == "Femenino") {
                    $query3 = $conn->prepare("UPDATE `stats` SET mujeres = mujeres + 1 WHERE id = 2");
                    $query3->execute();
                } else {
                    $query3 = $conn->prepare("UPDATE `stats` SET hombres = hombres + 1 WHERE id = 2");
                    $query3->execute();
                }
            }

            $conn->commit();

            $log['log'] = 'Guardado';
            echo json_encode($log, JSON_PRETTY_PRINT);
        } catch (PDOException $e) {
            $conn->rollBack();
            $log['error'] = 'Error en la consulta ' . $e->getMessage();
            echo json_encode($log, JSON_PRETTY_PRINT);
        }
    } else {
        $log['error'] = 'Campos vacios';
        echo json_encode($log, JSON_PRETTY_PRINT);
    }
}
