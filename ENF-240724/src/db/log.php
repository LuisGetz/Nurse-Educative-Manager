<?php

include 'conx.php';

if (isset($_POST['username']) && isset($_POST['passw'])) {
    $name = $_POST['username'];
    $password = $_POST['passw'];
    if (!empty($_POST['username']) && !empty($_POST['passw'])) {
        try {
            $query = $conn->prepare("SELECT nombres, username FROM usuarios WHERE correo = :name AND password = :password");
            $query->bindParam(':name', $name);
            $query->bindParam(':password', $password);
            $query->execute();

            $data = $query->fetch(PDO::FETCH_ASSOC);

            if (!empty($data)) {
                session_start();
                $_SESSION['username'] = $data['username'];
                $_SESSION['nombres'] = $data['nombres'];

                $log['success'] = 'Bienvenido ' . $data['username'];
                echo json_encode($log, JSON_PRETTY_PRINT);
            } else {
                $log['error'] = 'Correo o contraseña incorrectos.';
                echo json_encode($log, JSON_PRETTY_PRINT);
            }
        } catch (PDOException $e) {
            $log['error'] = 'Tenemos problemas para iniciar sesión, inténtalo de nuevo.';
            echo json_encode($log, JSON_PRETTY_PRINT);
        }
    } else {
        $log['dataEmpty'] = 'campos vacios';
        echo json_encode($log, JSON_PRETTY_PRINT);
    }
}
