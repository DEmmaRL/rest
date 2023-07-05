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

// Verificar si se recibió una solicitud DELETE
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset( $_POST["id"] ) ) {
    // Obtener el ID del registro a eliminar (debe ser enviado en la solicitud DELETE)
    $id = $_POST["id"];

    // Verificar si se proporcionó un ID válido
    if (!empty($id)) {
        // Consulta para eliminar el registro con el ID especificado
        $sql = "DELETE FROM eventos WHERE id = $id";

        // Ejecutar la consulta
        if ($conn->query($sql) === true) {
            // El registro se eliminó correctamente
            echo "Registro eliminado exitosamente.";
        } else {
            // Ocurrió un error al eliminar el registro
            echo "Error al eliminar el registro: " . $conn->error;
        }
    } else {
        // No se proporcionó un ID válido
        echo "ID no válido.";
    }
} else {
    echo "No tienes permiso.";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
