<?php

include 'conx.php';

if (isset($_POST['txtFolderQR'])) {
    $folder = $_POST['txtFolderQR'];
    if (!empty($folder)) {
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
                                                alumnos.numimss = :folder
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
                                                docentes.numimss = :folder
                                        ) ORDER BY fecha DESC");
            $query->bindParam(':folder', $folder);
            $query->execute();
            $result1 = $query->fetchAll(PDO::FETCH_ASSOC);

            $query2 = $conn->prepare("SELECT
                                        justificantes.id AS id,
                                        alumnos.nombre AS alumno,
                                        justificantes.link AS link,
                                        justificantes.fecha AS fecha
                                    FROM
                                        justificantes
                                    INNER JOIN alumnos ON alumnos.numimss = justificantes.alumno
                                    WHERE alumno = :folder
                                    ORDER BY fecha DESC");
            $query2->bindParam(':folder', $folder);
            $query2->execute();
            $result2 = $query2->fetchAll(PDO::FETCH_ASSOC);

            $query3 = $conn->prepare("SELECT
                                                alumnos.nombre,
                                                grupos.nombre AS grupo
                                            FROM
                                                alumnos
                                            INNER JOIN grupos ON grupos.id = alumnos.grupo
                                            WHERE
                                                numimss = :folder");
            $query3->bindParam(':folder', $folder);
            $query3->execute();
            $result3 = $query3->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($result1) || !empty($result2)) {
                $data['histcon'] = $result1;
                $data['justificantes'] = $result2;
                $data['alumno'] = $result3;
            } else {
                $data['error'] = 'No se encontraron registros.';
            }

            echo json_encode($data);
        } catch (PDOException $e) {
            $log['error'] = 'Ocurrió un error obteniendo datos. Intenta de nuevo.';
            echo json_encode($log, JSON_PRETTY_PRINT);
        }
    } else {
        $log['error'] = 'Campos vacios';
        echo json_encode($log, JSON_PRETTY_PRINT);
    }
}
