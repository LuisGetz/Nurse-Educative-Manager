<?php
include 'conx.php';

header('Content-Type: application/json');

try {
    if (isset($_GET['search'])) {
        $search = "%" . $_GET['search'] . "%";
        $query = $conn->prepare("
            (SELECT
                alumnos.numimss AS numimss,
                alumnos.nombre AS nombre,
                alumnos.edad AS edad,
                alumnos.sexo AS sexo,
                alumnos.grupo AS grupoid,
                alumnos.alergias AS alergia,
                NULL AS telefono,
                grupos.nombre AS grupo
            FROM
                alumnos
            INNER JOIN grupos ON grupos.id = alumnos.grupo
            WHERE
                alumnos.numimss LIKE :search OR alumnos.nombre LIKE :search OR alumnos.grupo LIKE :search OR grupos.nombre LIKE :search
            )
            UNION
            (
            SELECT
                docentes.numimss AS numimss,
                docentes.nombre AS nombre,
                docentes.edad AS edad,
                docentes.sexo AS sexo,
                docentes.grupo AS grupoid,
                docentes.alergias AS alergia,
                docentes.numtelef AS telefono,
                grupos.nombre AS grupo
            FROM
                docentes
            INNER JOIN grupos ON grupos.id = docentes.grupo
            WHERE
                docentes.numimss LIKE :search OR docentes.nombre LIKE :search OR docentes.grupo LIKE :search OR grupos.nombre LIKE :search
            )");
        $query->bindParam(':search', $search);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data, JSON_PRETTY_PRINT);
    } else if (isset($_GET['data'])) {
        $id = $_GET['data'];
        $query = $conn->prepare("
            (SELECT
                alumnos.numimss AS numimss,
                alumnos.nombre AS nombre,
                alumnos.edad AS edad,
                alumnos.sexo AS sexo,
                alumnos.grupo AS grupoid,
                alumnos.alergias AS alergia,
                NULL AS telefono,
                grupos.nombre AS grupo
            FROM
                alumnos
            INNER JOIN grupos ON grupos.id = alumnos.grupo
            WHERE
                alumnos.numimss = :id
            )
            UNION
            (
            SELECT
                docentes.numimss AS numimss,
                docentes.nombre AS nombre,
                docentes.edad AS edad,
                docentes.sexo AS sexo,
                docentes.grupo AS grupoid,
                docentes.alergias AS alergia,
                docentes.numtelef AS telefono,
                grupos.nombre AS grupo
            FROM
                docentes
            INNER JOIN grupos ON grupos.id = docentes.grupo
            WHERE
                docentes.numimss = :id
            )");
        $query->bindParam(':id', $id);
        $query->execute();

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data, JSON_PRETTY_PRINT);
    } else if (isset($_GET['del'])) {
        $delid = $_GET['del'];
        $rol = $_GET['cat'];
        if ($rol != "45") {
            $query = $conn->prepare("DELETE FROM `alumnos` WHERE numimss = :id");
            $query->bindParam(':id', $delid);
            $query->execute();
        } else {
            $query = $conn->prepare("DELETE FROM `docentes` WHERE numimss = :id");
            $query->bindParam(':id', $delid);
            $query->execute();
        }
    } else {
        $query = $conn->prepare("
            SELECT
                alumnos.numimss AS numimss,
                alumnos.nombre AS nombre,
                alumnos.edad AS edad,
                alumnos.sexo AS sexo,
                alumnos.grupo AS grupoid,
                alumnos.alergias AS alergia,
                NULL AS telefono,
                grupos.nombre AS grupo
            FROM
                alumnos
            INNER JOIN grupos ON grupos.id = alumnos.grupo
            UNION ALL
            SELECT
                docentes.numimss AS numimss,
                docentes.nombre AS nombre,
                docentes.edad AS edad,
                docentes.sexo AS sexo,
                docentes.grupo AS grupoid,
                docentes.alergias AS alergia,
                docentes.numtelef AS telefono,
                grupos.nombre AS grupo
            FROM
                docentes
            INNER JOIN grupos ON grupos.id = docentes.grupo
        ");
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
