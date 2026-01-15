<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Fecha</title>
</head>
<body>
    <form method="post" action="">
        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha">
        <input type="submit" value="Enviar">
    </form>

    <?php
    if (isset($_POST['fecha'])) {
        $fecha = $_POST['fecha'];
        $timestamp = strtotime($fecha);
        $format = new IntlDateFormatter('es_ES', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
        $date = $format->format($timestamp);
        echo "<p>La fecha seleccionada es: $date</p>";
    }
    ?>
</body>
</html></head>