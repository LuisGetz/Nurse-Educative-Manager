<?php
include 'conx.php';

$responses = array();
function peticion($prompt)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://openrouter.ai/api/v1/chat/completions');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');

    $token = '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';

    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $token,
    ]);

    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
        "model" => "deepseek/deepseek-chat:free",
        "messages" => [
            [
                "role" => "system",
                "content" => "Eres un asistente especializado en análisis de datos. Procesa JSON y devuelve respuestas en formato JSON estricto, sin comentarios."
            ],
            [
                "role" => "user",
                "content" => $prompt
            ]
        ]
    ]));

    $response = curl_exec($ch);
    curl_close($ch);
    //print_r($response);

    $res = json_decode($response, JSON_PRETTY_PRINT);
    $text = $res['choices'][0]['message']['content'];
    $json = preg_replace('/```json\\s*|```/', '', $text);
    $json = trim($json);
    $cleandata = json_decode($json, JSON_PRETTY_PRINT);
    return $cleandata;
}

function getdata($conn, $sentencia)
{
    try {
        $queryF = $conn->prepare($sentencia);
        $queryF->execute();
        $data = $queryF->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    } catch (PDOException $e) {
        $log['error'] = 'Campos vacios';
        echo json_encode($log, JSON_PRETTY_PRINT);
    }
}

//region dashboard
$query = "(
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
                            )";
$res = json_encode(getdata($conn, $query), JSON_PRETTY_PRINT);
//region string
$string = 'Analiza el siguiente array JSON completo y calcula:
1. **Total de registros**: Cuenta todos los objetos → "consultas".
2. **Suma de medicamentos**: Convierte "cant" a número y súmalo → "medicamentos".
3. **Alumnos**: Si "grupo" no es "Docente" → +1 a "alumnos".
4. **Personal**: Si "grupo" es "Docente" → +1 a "personal".

**Reglas**:
- "cant" es siempre un string numérico (ej. "2" → 2).
- Solo "Docente" cuenta como personal (case-sensitive).
- ¡Usa TODOS los registros del array! ' . $res . '**Ejemplo de salida CORRECTA** (para tus datos):

**Ejemplo de salida CORRECTA** (para tus datos):

{
  "consultas": [numero de consultas],
  "medicamentos": [numero de medicamentos],
  "alumnos": [numero de alumnos],
  "personal": [numero de personal]
}
';
//endregion

$responses['dashboard'] = peticion($string);
//endregion

//region stat cons
$query = "SELECT * FROM histcon";
$res = json_encode(getdata($conn, $query), JSON_PRETTY_PRINT);
$string = 'Analiza el siguiente conjunto de datos JSON de consultas médicas. Para cada registro, extrae la fecha del campo "fecha" y determina el día de la semana correspondiente (Lunes, Martes, Miércoles, Jueves, Viernes, Sábado, Domingo).

            Luego, cuenta el número total de consultas que ocurren en cada día de la semana dentro del conjunto de datos.

            Finalmente, calcula la media del número de consultas por cada día de la semana dividiendo el número total de consultas para ese día entre el número de veces que ese día aparece en el conjunto de datos (que debería ser 1 si estamos calculando la media de la *cantidad* de gente que va en ese día, o podríamos normalizarlo si tuviéramos un período de tiempo más largo y quisiéramos la media *por semana*).

            Devuelve un objeto JSON en el formato de Chart.js para un gráfico de líneas, donde las etiquetas (`labels`) sean los días de la semana (Lunes, Martes, Miércoles, Jueves, Viernes) y los datos (`data`) en el dataset representen la media de consultas para cada uno de esos días redondeado al entero siguiente.
' . $res . ' **Para realizar las siguientes operaciones, procesa cada objeto (registro) individualmente dentro del array JSON de la siguiente manera:**

                * **Identifica cada objeto** delimitado por llaves "{}".
                
                **Realiza las siguientes operaciones:**
                **La media de datos los colocarás en datasets -> data. ** 
                **Devuelve ÚNICAMENTE el siguiente objeto JSON, NO QUIERO RESPUESTAS EXTRA:**
                ```json
                {
                "labels": ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes"],
                "datasets": [{
                    "label": "Consultas",
                    "data": [],
                    "fill": true,
                    "backgroundColor": "rgba(255, 71, 71, 0.2)",
                    "borderColor": "rgb(189, 4, 4)",
                    "borderWidth": 1,
                    "tension": 0.2
                }]
                }';

$responses['cons'] = peticion($string);
//endregion

//region medic
$query = "(
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
                            ) ORDER BY fecha DESC";
$res = json_encode(getdata($conn, $query), JSON_PRETTY_PRINT);

//region string
$string = 'Analiza el siguiente conjunto de datos JSON de consultas médicas. Cuenta la frecuencia de cada medicamento listado en el campo "medic_name".

Identifica los cuatro medicamentos más utilizados y sus respectivos conteos. El quinto elemento en los resultados debe representar la suma del conteo de todos los demás medicamentos menos frecuentes, agrupados bajo la etiqueta "Otros".

Devuelve un objeto JSON en el formato de Chart.js para un gráfico de pastel (puedes usar los colores proporcionados como ejemplo), donde las etiquetas (`labels`) sean los nombres de los cuatro medicamentos más comunes y "Otros", y los datos (`data`) en el dataset representen la frecuencia de uso (suma de las veces recetado) de cada uno.' . $res . '**Devuelve ÚNICAMENTE el siguiente objeto JSON:**

```json
{
  "labels": [],
  "datasets": [{
    "label": "Uso de Medicamentos",
    "data": [],
    "backgroundColor": [
      "rgba(255, 99, 132, 0.6)",
      "rgba(54, 162, 235, 0.6)",
      "rgba(255, 206, 86, 0.6)",
      "rgba(75, 192, 192, 0.6)",
      "rgba(153, 102, 255, 0.6)"
    ],
    "borderColor": [
      "rgba(255, 99, 132, 1)",
      "rgba(54, 162, 235, 1)",
      "rgba(255, 206, 86, 1)",
      "rgba(75, 192, 192, 1)",
      "rgba(153, 102, 255, 1)"
    ],
    "borderWidth": 1
  }]
}';
//endregion

$responses['medic'] = peticion($string);
//endregion

//region mot
$query = "SELECT * FROM histcon";
$res = json_encode(getdata($conn, $query), JSON_PRETTY_PRINT);
$string = 'Analiza el siguiente conjunto de datos JSON de consultas médicas. Cuenta la frecuencia de cada motivo de consulta listado en el campo "sintomas". Agrupa los motivos que son similares (por ejemplo, "Dolor de cabeza" y "Dolor de Cabeza" deben contarse juntos).

Identifica los cuatro motivos de consulta más comunes y sus respectivos conteos. El quinto elemento en los resultados debe representar la suma del conteo de todos los demás motivos de consulta menos frecuentes, agrupados bajo la etiqueta "Otros".

Devuelve un objeto JSON en el formato de Chart.js para un gráfico de barras (puedes usar los colores proporcionados como ejemplo), donde las etiquetas (`labels`) sean los nombres de los cuatro motivos más comunes y "Otros", y los datos (`data`) en el dataset representen la frecuencia de cada uno.
' . $res . '**Devuelve ÚNICAMENTE el siguiente objeto JSON:**

        ```json
        {
        "labels": [],
        "datasets": [{
            "label": "Motivos de Consulta",
            "data": [],
            "backgroundColor": [
            "rgba(144, 238, 144, 0.5)",
            "rgba(255, 99, 132, 0.5)", 
            "rgba(255, 206, 86, 0.5)", 
            "rgba(54, 162, 235, 0.5)", 
            "rgba(153, 102, 255, 0.5)" 
          ],
          borderColor: [
            "rgba(144, 238, 144, 1)",
            "rgba(255, 99, 132, 1)",
            "rgba(255, 206, 86, 1)",
            "rgba(54, 162, 235, 1)",
            "rgba(153, 102, 255, 1)"
          ],
            "borderWidth": 1
        }]
        }';

$responses['mot'] = peticion($string);
//endregion

//region gender
$query = "(
                                SELECT
                                    histcon.id AS id,
                                    alumnos.nombre AS nombre,
    								alumnos.sexo AS sexo,
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
                                    docentes.sexo AS sexo,
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
                            )";
$res = json_encode(getdata($conn, $query), JSON_PRETTY_PRINT);
$string = 'Analiza el siguiente conjunto de datos JSON de consultas médicas. Cuenta el número total de consultas realizadas por personas de sexo "Masculino" y el número total de consultas realizadas por personas de sexo "Femenino".

Devuelve un objeto JSON con la estructura proporcionada, donde la clave "labels" contenga un array con los strings "Hombre" y "Mujer", y la clave "datasets" contenga un array con un objeto. Este objeto tendrá una clave "data" cuyo valor será un array de dos números: el total de consultas de hombres y el total de consultas de mujeres, en ese orden.' . $res . '**Devuelve ÚNICAMENTE el siguiente objeto JSON:**

        ```json
        {
        labels: [Hombre, Mujer],
        datasets: [{
          label: Distribución por género,
          data: [55, 45], // Puedes cambiar estos valores
          backgroundColor: [
            rgba(54, 162, 235, 0.2),
            rgba(255, 99, 132, 0.2) 
          ],
          borderColor: [
            rgba(54, 162, 235, 1),  
            rgba(255, 99, 132, 1)   
          ],
          borderWidth: 2
        }]
      }';

$responses['gender'] = peticion($string);
//endregion

//region tables

//region medic-percentage
$res = json_encode(getdata($conn, "SELECT * FROM medicamento"), JSON_PRETTY_PRINT);
//region string 
$string = 'Analiza el siguiente conjunto de datos JSON de medicamentos. Identifica los tipos de medicamentos ÚNICAMENTE presentes en el campo "tipo". Suma la cantidad total para cada uno de estos tipos presentes. Calcula el porcentaje de la cantidad total de cada tipo con respecto a la cantidad total del inventario, redondeando al entero más cercano.

Devuelve un objeto JSON con las claves "porcentajes" y "labels". "labels" debe contener los nombres de los tipos encontrados (Pastilla, Botiquín). "porcentajes" debe contener los porcentajes correspondientes a estos tipos, en el mismo orden.' . $res . '**Devuelve ÚNICAMENTE el siguiente array JSON:**

```json
[
  {
    "porcentajes": []
  }
]';
//endregion
$responses['tables']['medic'] = peticion($string);
//endregion

//region gender-type
$res = json_encode(getdata($conn, "(
                                SELECT
                                    histcon.id AS id,
                                    alumnos.nombre AS nombre,
    								alumnos.sexo AS sexo,
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
                                    docentes.sexo AS sexo,
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
                            )"), JSON_PRETTY_PRINT);
//region string 
$string = 'Analiza el siguiente conjunto de datos JSON de consultas médicas. Calcula el porcentaje de mujeres y el porcentaje de hombres que fueron a consulta.

Devuelve un objeto JSON con dos claves principales: "porcentajes" y "labels".

El valor de la clave "porcentajes" debe ser un array que contenga dos números: el porcentaje de mujeres (redondeado al entero más cercano) y el porcentaje de hombres (redondeado al entero más cercano), en ese orden.

El valor de la clave "labels" debe ser un array que contenga dos strings: "Mujeres" y "Hombres", en ese orden.' . $res . '**Devuelve ÚNICAMENTE el siguiente array JSON:**

```json
[
  {
  "porcentajes": [],
  "labels": []
}
]';
//endregion
$responses['tables']['gender'] = peticion($string);
//endregion

//region groups
$res = json_encode(getdata($conn, "(
    SELECT
        histcon.id AS id,
        alumnos.nombre AS nombre,
        alumnos.sexo AS sexo,
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
        docentes.sexo AS sexo,
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
)"), JSON_PRETTY_PRINT);
//region string 
$string = 'Analiza el siguiente conjunto de datos JSON de consultas médicas. Cuenta cuántas veces fue cada grupo diferente a consulta (cada registro representa una visita). Calcula el total de visitas realizadas. Luego, calcula el porcentaje que representa cada grupo sobre el total de visitas, redondeando el porcentaje al entero más cercano.

Devuelve un objeto JSON con tres claves principales: "porcentajes", "labels" y "visitas".

El valor de la clave "porcentajes" debe ser un array que contenga los porcentajes (redondeados al entero más cercano) de cada grupo, en el orden en que se encuentren los grupos en los datos (o en un orden lógico como alfabético si lo prefieres, indícalo si es así).

El valor de la clave "labels" debe ser un array que contenga los nombres de cada grupo único encontrado en los datos, en el mismo orden que los porcentajes.

El valor de la clave "visitas" debe ser un array que contenga el número de visitas (conteo) para cada grupo, en el mismo orden que los porcentajes y los labels.' . $res . '**Devuelve ÚNICAMENTE el siguiente array JSON:**

```json
[
{
  "porcentajes": [],
  "labels": [],
  "visitas": []
}
]';
$responses['tables']['groups'] = peticion($string);
//endregion
//endregion

//endregion
echo json_encode($responses, JSON_PRETTY_PRINT);
