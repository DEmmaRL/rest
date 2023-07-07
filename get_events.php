<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agenda";

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Error al conectar a la base de datos: " . $conn->connect_error);
}

// Verificar si se recibió una solicitud POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Consulta para obtener todos los registros de la tabla "eventos"
    $sql = "SELECT * FROM eventos WHERE isCompleted = 0 ";

    // Ejecutar la consulta
    $result = $conn->query($sql);

    // Verificar si se encontraron registros
    if ($result->num_rows > 0) {
        // Crear un arreglo para almacenar los datos de los registros
        $registros = array();

        // Recorrer los resultados de la consulta
        while ($row = $result->fetch_assoc()) {
            // Agregar cada registro al arreglo
            $registros[] = $row;
        }

        // Devolver los registros como una respuesta JSON
        header("Content-Type: application/json");
        echo json_encode($registros);
    } else {
        // No se encontraron registros
        echo "No se encontraron registros.";
    }
}
else
{
    echo "No tienes permisooo";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>