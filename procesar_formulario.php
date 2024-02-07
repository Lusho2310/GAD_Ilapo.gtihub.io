<?php 
    include "mi_conexion.php";

    // Verificar si se recibió una solicitud POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recuperar los datos del formulario
        $tipo_bien = $_POST['tipo_bien'];
        $codigo = $_POST['codigo'];
        $cantidad = $_POST['cantidad'];
        $descripcion = $_POST['descripcion'];
        $observacion = $_POST['observacion'];
        $ubicacion = $_POST['ubicacion'];
        $fecha_adquisicion = $_POST['fecha_adquisicion'];
        $numero_factura = $_POST['numero_factura'];
        $total = $_POST['total'];

        // Establecer conexión a la base de datos
        $db = new Database();
        $con = $db->conectar();

        // Preparar la consulta SQL para insertar datos en la tabla "bienes"
        $sql = $con->prepare("INSERT INTO bienes (tipo_bien, codigo, cantidad, descripcion, observacion, ubicacion, fecha_adquisicion, numero_factura, total) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Ejecutar la consulta SQL con los datos proporcionados
        if ($sql->execute([$tipo_bien, $codigo, $cantidad, $descripcion, $observacion, $ubicacion, $fecha_adquisicion, $numero_factura, $total])) {
            // Si la inserción fue exitosa, redirigir a una página de éxito o mostrar un mensaje
            header("Location: Inventario.php");
            exit();
        } else {
            // Si hubo un error durante la inserción, mostrar un mensaje de error
            echo "Error al registrar el bien. Por favor, inténtalo nuevamente.";
        }
    }
?>