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

// Verificar si se recibió una solicitud POST y si se proporcionó el parámetro "id"
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"]) && isset($_POST["field"]) && isset($_POST["value"])) {
    // Obtener el ID, el campo y el valor del registro a actualizar
    $id = $_POST["id"];
    $campo_actualizar = $_POST["field"];
    $valor_actualizar = $_POST["value"];


        // Aquí puedes realizar las operaciones de actualización del registro con el ID especificado
        // Puedes utilizar las variables $id, $campo_actualizar y $valor_actualizar en tus consultas para identificar el registro que deseas actualizar y especificar el campo y el valor a actualizar

        $sql = "UPDATE eventos SET $campo_actualizar = '$valor_actualizar' WHERE id = $id";

        if ($conn->query($sql) === true) {
            // El registro se actualizó correctamente
            echo "Registro actualizado exitosamente.";
        } else {
            // Ocurrió un error al actualizar el registro
            echo "Error al actualizar el registro: " . $conn->error;
        }
}
 else {
    echo "No tienes permiso.";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
