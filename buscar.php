<?php
// Conectar a la base de datos
include "mi_conexion.php";
$db = new Database();
$con = $db->conectar();

// Obtener el valor de búsqueda enviado desde JavaScript
$q = $_GET['q'];

// Consultar la base de datos para obtener resultados coincidentes
$sql = $con->prepare("SELECT * FROM bienes WHERE columna LIKE ?");
$sql->execute(["%$q%"]);
$resultados = $sql->fetchAll(PDO::FETCH_ASSOC);

// Mostrar los resultados
if ($resultados) {
    foreach ($resultados as $resultado) {
        echo "<p>" . $resultado['columna'] . "</p>";
    }
} else {
    echo "No se encontraron resultados";
}
?>