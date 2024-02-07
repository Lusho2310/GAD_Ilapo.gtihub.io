<?php
include "mi_conexion.php";

// Verificar si se ha enviado el formulario de edición
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

    // Establecer la conexión a la base de datos
    $db = new Database();
    $con = $db->conectar();

    // Verificar si la conexión se realizó correctamente
    if ($con) {
        // Recuperar el ID del registro que se va a editar
        $id = $_POST['id'];

        // Actualizar los datos en la base de datos
        $sql = $con->prepare("UPDATE bienes SET tipo_bien=?, codigo=?, cantidad=?, descripcion=?, observacion=?, ubicacion=?, fecha_adquisicion=?, numero_factura=?, total=? WHERE id=?");
        $sql->execute([$tipo_bien, $codigo, $cantidad, $descripcion, $observacion, $ubicacion, $fecha_adquisicion, $numero_factura, $total, $id]);

        // Redirigir a la página donde se muestran los datos actualizados
        header("Location: Inventario.php");
        exit();
    } else {
        echo "Error al conectar a la base de datos";
    }
}

// Recuperar el ID del registro que se va a editar
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Verificar si se ha proporcionado un ID
if ($id === null) {
    // Si no se proporciona un ID, mostrar un mensaje de error y salir del script
    echo "Error: No se proporcionó un ID para editar";
    exit();
}

// Establecer la conexión a la base de datos
$db = new Database();
$con = $db->conectar();

// Verificar si la conexión se realizó correctamente
if ($con) {
    // Consultar los datos del registro específico
    $sql = $con->prepare("SELECT * FROM bienes WHERE id=?");
    $sql->execute([$id]);
    $datos = $sql->fetch(PDO::FETCH_ASSOC);

    // Verificar si se encontraron datos para el ID dado
    if (!$datos) {
        // Si no se encuentran datos para el ID dado, mostrar un mensaje de error y salir del script
        echo "Error: No se encontraron datos para el ID proporcionado";
        exit();
    }
} else {
    echo "Error al conectar a la base de datos";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <title>Ventana3</title>
    <link rel="stylesheet" href="css/registro.css">
</head>

<body>
    <div id="contenido-comun"></div>
    <script src="nav_var.js" defer></script>
    <div>
    <h1>Editar Datos</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="tipo_bien">Tipo de Bien:</label>
        <input type="text" name="tipo_bien" value="<?php echo $datos['tipo_bien']; ?>" required>
        <label for="codigo">Código:</label>
        <input type="text" name="codigo" id="codigo" value="<?php echo $datos['codigo']; ?>" required>
        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" id="cantidad" value="<?php echo $datos['cantidad']; ?>" required>
        <label for="descripcion">Descripción del Bien:</label>
        <textarea name="descripcion" id="descripcion" rows="4" cols="50" required><?php echo $datos['descripcion']; ?></textarea>
        <label for="observacion">Observación:</label>
        <textarea name="observacion" id="observacion" rows="4" cols="50" value="<?php echo $datos['observacion']; ?>" ></textarea>
        <label for="ubicacion">Ubicación:</label>
        <input type="text" name="ubicacion" id="ubicacion" value="<?php echo $datos['ubicacion']; ?>" required>
        <label for="fecha_adquisicion">Fecha de Adquisición:</label>
        <input type="date" name="fecha_adquisicion" id="fecha_adquisicion" value="<?php echo $datos['fecha_adquisicion']; ?>" required>
        <label for="numero_factura">Número de Factura:</label>
        <input type="text" name="numero_factura" id="numero_factura" value="<?php echo $datos['numero_factura']; ?>" required>
        <label for="total">Total:</label>
        <input type="text" name="total" id="total" step="0.01" value="<?php echo $datos['total']; ?>" required>
        <!-- Agregar los demás campos del formulario con los valores recuperados de la base de datos -->
        <button type="submit">Guardar Cambios</button>
    </form>
    </div>
    
</body>
</html>