<?php

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);
include "../db/conx.php";

$fechaHoy = date("Y-m-d");
$file = 'documento.pdf';
$token = 'EAAR12aKaxRoBOz3iiHbpsaF8iOcaB6ADdyCCjBJWDjPWZAAsFUoQrbPQGZBXGwYvHfImeCjoYVX8n6Pxbz1WYOmZCKOZAy8wgnXZCMqgvPezYrEpmFkue6hAZBxgvQxAwViHfZC6gnS2JH3AI43ijqPEeDHTVxjqOOZC4etYkgtlnE3D7wPNI656DfpJ47hXgQuEmwZDZD';
$log = array();
$datawhs = array();

clearstatcache();

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/v21.0/347874315076184/media');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $token,
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, [
        'file' => new CURLFile($file, 'application/pdf'),
        'type' => 'application/pdf',
        'messaging_product' => 'whatsapp',
    ]);

    $response = curl_exec($ch);
    $decode = json_decode($response, true);
    $mediaID = $decode['id'];

    curl_close($ch);

    $nums = array_filter($_POST['num']);
    foreach ($nums as $phone) {
        $msj = [
            "messaging_product" => "whatsapp",
            "recipient_type" => "individual",
            "to" => $phone,
            "type" => "template",
            "template" => [
                "name" => "justificante",
                "language" => [
                    "code" => "es_MX"
                ],
                "components" => [
                    [
                        "type" => "header",
                        "parameters" => [
                            [
                                "type" => "document",
                                "document" => [
                                    "id" => "$mediaID",
                                    "filename" => "documento.pdf"
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/v21.0/347874315076184/messages');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json',
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($msj));

        $response = curl_exec($ch);

        $datawhs = json_decode($response, true);
        curl_close($ch);
    }


    if (isset($datawhs['messages'][0]['message_status'])) {
        try {
            $query = $conn->prepare("INSERT INTO `justificantes`(`id`, `alumno`, `link`, `fecha`) VALUES (null,:alumno,:url,:date)");
            $query->bindParam(":alumno", $_POST['numimss']);
            $query->bindParam(":url", $_POST['url']);
            $query->bindParam(":date", $fechaHoy);
            $query->execute();

            $log['log'] = "Se guardo correctamente. ";
            echo json_encode($log, JSON_PRETTY_PRINT);
            unlink($file);
        } catch (PDOException $e) {
            $log['error'] = "Error insertando guardando el justificante. " . $e;
            echo json_encode($log, JSON_PRETTY_PRINT);
        }
    } else {
        $log['error'] = "No se envio el justificante. ";
        echo json_encode($log, JSON_PRETTY_PRINT);
    }/* 
} else {
    $log['error'] = "No existe un archivo. Haga un documento";
    echo json_encode($log, JSON_PRETTY_PRINT);
}
 */