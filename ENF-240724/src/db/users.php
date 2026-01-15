<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);

include 'conx.php';
header('Content-Type: application/json');

$log = array();

if (isset($_POST['num-imss'])) {
    $imss = $_POST['num-imss'];
    $username = $_POST['username'];
    $names = $_POST['names'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ((!empty($imss) && !empty($username) && !empty($names) && !empty($email) && !empty($password))) {
        try {
            $query = $conn->prepare("INSERT INTO `usuarios`(`numimss`, `username`, `nombres`, `correo`, `password`) VALUES (:imss, :username, :names, :email, :password)");
            $query->bindParam(':imss', $imss);
            $query->bindParam(':username', $username);
            $query->bindParam(':names', $names);
            $query->bindParam(':email', $email);
            $query->bindParam(':password', $password);
            $query->execute();

            $log['log'] = 'Datos guardados correctamente';
            echo json_encode($log, JSON_PRETTY_PRINT);
        } catch (PDOException $e) {
            $log['error'] = 'Error en la consulta: ' . $e->getMessage();
            echo json_encode($log, JSON_PRETTY_PRINT);
        }
    } else {
        $log['error'] = "No se guardó: Campos vacios";
        echo json_encode($log, JSON_PRETTY_PRINT);
    }
}
if (isset($_POST['mus-id'])) {
    $musid = $_POST['mus-id'];
    $musimss = $_POST['mus-imss'];
    $mususername = $_POST['mus-username'];
    $musnames = $_POST['mus-names'];
    $musemail = $_POST['mus-email'];
    $muspassword = $_POST['mus-password'];

    if (!empty($musid) && !empty($musimss) && !empty($mususername) && !empty($musnames) && !empty($musemail) && !empty($muspassword)) {
        try {
            $query = $conn->prepare("UPDATE usuarios SET numimss=:musimss, username=:mususername, nombres=:musnames, correo=:musemail, password=:muspassword WHERE numimss =:musid");
            $query->bindParam(':musid', $musid);
            $query->bindParam(':musimss', $musimss);
            $query->bindParam(':mususername', $mususername);
            $query->bindParam(':musnames', $musnames);
            $query->bindParam(':musemail', $musemail);
            $query->bindParam(':muspassword', $muspassword);
            $query->execute();
            $log['log'] = 'se guardaron los datos en usuarios';
            echo json_encode($log, JSON_PRETTY_PRINT);
        } catch (PDOException $e) {
            $log['error'] = 'Error interno del servidor: '.$e->getMessage();
            echo json_encode($log, JSON_PRETTY_PRINT);
        }
    } else {
        $log['error'] = 'campos vacios';
        echo json_encode($log, JSON_PRETTY_PRINT);
    }
}

if (isset($_GET['getdata'])) {
    try {
        $query = $conn->prepare("SELECT * FROM usuarios");
        $query->execute();

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data, JSON_PRETTY_PRINT);
    } catch (PDOException $e) {
        $log['error'] = 'Error: ' . $e->getMessage();
        echo json_encode($log, JSON_PRETTY_PRINT);
    }
}

if (isset($_GET['search'])) {
    $search = '%' . $_GET['search'] . '%';
    try {
        $query = $conn->prepare("SELECT * FROM `usuarios` WHERE
            numimss LIKE :search 
            OR username LIKE :search 
            OR nombres LIKE :search 
            OR correo LIKE :search");
        $query->bindParam(":search", $search);
        $query->execute();

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data, JSON_PRETTY_PRINT);
    } catch (PDOException $e) {
        $log['error'] = 'No se guardo';
        echo json_encode($log, JSON_PRETTY_PRINT);
    }
}

if (isset($_GET['del'])) {
    $delid = $_GET['del'];
    try {
        $query = $conn->prepare("DELETE FROM `usuarios` WHERE numimss = :id");
        $query->bindParam(':id', $delid);
        $query->execute();

        $log['log'] = 'si se elimino';
        echo json_encode($log, JSON_PRETTY_PRINT);
    } catch (PDOException $e) {
        $log['error'] = 'No se elimino'.$e->getMessage();
        echo json_encode($log, JSON_PRETTY_PRINT);
    }
}
