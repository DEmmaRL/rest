<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Print the POST array
    print_r($_POST);
}
// Variables POST requeridas
$requiredFields = array('title', 'note', 'date', 'startTime', 'endTime', 'remind', 'repeat', 'color', 'isCompleted');

// Verificar si se recibieron los datos por POST
$missingFields = array();
foreach ($requiredFields as $field) {
    if (!isset($_POST[$field])) {
        $missingFields[] = $field;
    }
}

if (!empty($missingFields)) {
    $response = array(
        'success' => false,
        'message' => 'Faltan datos requeridos',
        'missingFields' => $missingFields
    );
} else {
    // Obtener los datos enviados por POST
    $title = $_POST['title'];
    $note = $_POST['note'];
    $date = $_POST['date'];
    $startTime = $_POST['startTime'];
    $endTime = $_POST['endTime'];
    $remind = $_POST['remind'];
    $repeat = $_POST['repeat'];
    $color = $_POST['color'];
    $isCompleted = $_POST['isCompleted'];

    // Validar los datos si es necesario
    // ...

    // Conectar a la base de datos
    // Conectar a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "agenda";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Error al conectar a la base de datos: " . $conn->connect_error);
    }

    // Crear la consulta SQL
    $sql = "INSERT INTO eventos (title, note, fecha_creacion, startTime, endTime, remind, repetir, color, isCompleted) 
    VALUES ('$title', '$note', '$date', '$startTime', '$endTime', '$remind', '$repeat', $color, $isCompleted)";

        // Ejecutar la consulta
        if ($conn->query($sql) === TRUE) {
        $response = array('success' => true, 'message' => 'Evento insertado correctamente');
        } else {
        $response = array('success' => false, 'message' => 'Error al insertar el evento: ' . $conn->error);
        }

    // Cerrar la conexión a la base de datos
    $conn->close();
}

// Enviar la respuesta como JSON
header('Content-Type: application/json');
echo json_encode($response);
