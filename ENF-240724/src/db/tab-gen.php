<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);

include 'conx.php';
header('Content-Type: application/json');

$res = array();

if (isset($_POST['num'])) {
    $num = $_POST['num'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $sexo = $_POST['sexo'];
    $group = $_POST['group'];
    $alerg = $_POST['alerg'];
    $phone = $_POST['phone'];

    if (!empty($num) && !empty($name) && !empty($age) && !empty($sexo) && !empty($group)) {
        try {
            if ($group != "45") {
                $query = $conn->prepare("INSERT INTO alumnos(numimss, nombre, edad, sexo, grupo, alergias) VALUES (:numimss, :nombre, :edad, :sexo, :grupo, :alergias)");
                $query->bindParam(':numimss', $num);
                $query->bindParam(':nombre', $name);
                $query->bindParam(':edad', $age);
                $query->bindParam(':sexo', $sexo);
                $query->bindParam(':grupo', $group);
                $query->bindParam(':alergias', $alerg);
                $query->execute();
            } else {
                $query = $conn->prepare("INSERT INTO docentes(numimss, nombre, edad, sexo, grupo, alergias, numtelef) VALUES (:numimss, :nombre, :edad, :sexo, :grupo, :alergias, :phone)");
                $query->bindParam(':numimss', $num);
                $query->bindParam(':nombre', $name);
                $query->bindParam(':edad', $age);
                $query->bindParam(':sexo', $sexo);
                $query->bindParam(':grupo', $group);
                $query->bindParam(':alergias', $alerg);
                $query->bindParam(':phone', $phone);
                $query->execute();
            }
            $res["log"] = "se guardo";
        } catch (PDOException $e) {
            $res["error"] = "No se guardó: " . $e->getMessage();
            exit;
        }
    } else {
        $res["error"] = "No se guardó: Campos vacios num=$num name=$name age=$age sexo=$sexo group=$group alerg=$alerg phone=$phone";
    }
    echo json_encode($res, JSON_PRETTY_PRINT);
} else if (isset($_POST['mg-id'])) {
    $mgid = $_POST['mg-id'];
    $mgidg = $_POST['mg-id-g'];
    $mgnumimss = $_POST['mg-numimss'];
    $mgname = $_POST['mg-name'];
    $mgage = $_POST['mg-age'];
    $mgsexo = $_POST['mg-sexo'];
    $mggroup = $_POST['mg-group'];
    $mgalerg = $_POST['mg-alerg'];
    $mgphone = $_POST['mg-phone'];

    if(!empty($mgid) && !empty($mgidg) && !empty($mgnumimss) && !empty($mgname) && !empty($mgage) && !empty($mgsexo) && !empty($mggroup)){
    try {
        if ($mgidg != "45") {
            $query = $conn->prepare("UPDATE alumnos SET numimss=:numimss, nombre=:nombre, edad=:edad, grupo=:grupo, sexo=:sexo, alergias=:alergias WHERE numimss=:idnumimss");
            $query->bindParam(':numimss', $mgnumimss);
            $query->bindParam(':nombre', $mgname);
            $query->bindParam(':edad', $mgage);
            $query->bindParam(':sexo', $mgsexo);
            $query->bindParam(':grupo', $mggroup);
            $query->bindParam(':alergias', $mgalerg);
            $query->bindParam(':idnumimss', $mgid);
            $query->execute();
        } else {
            $query = $conn->prepare("UPDATE docentes SET numimss=:numimss, nombre=:nombre, edad=:edad, grupo=:grupo, sexo=:sexo, alergias=:alergias, numtelef=:phone WHERE numimss=:idnumimss");
            $query->bindParam(':numimss', $mgnumimss);
            $query->bindParam(':nombre', $mgname);
            $query->bindParam(':edad', $mgage);
            $query->bindParam(':sexo', $mgsexo);
            $query->bindParam(':grupo', $mggroup);
            $query->bindParam(':alergias', $mgalerg);
            $query->bindParam(':idnumimss', $mgid);
            $query->bindParam(':phone', $mgphone);
            $query->execute();
        }
        $res["log"] = "se guardo";
    } catch (PDOException $e) {
        $res["error"] = "No se guardó: " . $e->getMessage();
        echo json_encode($res, JSON_PRETTY_PRINT);
        exit;
    }
    }else{
        $res["error"] = "No se guardó: Campos vacios mgid=$mgid mgidg=$mgidg mgnumimss=$mgnumimss mgname=$mgname mgage=$mgage mgsexo=$mgsexo mggroup=$mggroup mgalerg=$mgalerg mgphone=$mgphone
";
    }
    echo json_encode($res, JSON_PRETTY_PRINT);
}
