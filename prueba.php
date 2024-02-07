<?php
// Configuración de conexión a la base de datos
$servername = "tu_servidor_mysql_remoto";
$username = "tu_usuario_mysql";
$password = "tu_contraseña_mysql";
$database = "tu_base_de_datos_mysql";

// Crear una conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Ejemplo de consulta
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

echo "<h2>Resultados de la consulta:</h2>";

if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Nombre</th></tr>";
    // Mostrar datos de cada fila
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"] . "</td><td>" . $row["fullname"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 resultados";
}
$conn->close();
?>
