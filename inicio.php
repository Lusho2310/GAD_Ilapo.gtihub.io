<?php 
    include "mi_conexion.php";

    $db = new Database();
    $con = $db->conectar();
    $sql = $con ->prepare("SELECT * FROM users");
    $sql->execute();
    $response = $sql->fetchALL(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <title>Inventario</title>
    <link rel="stylesheet" href="css/registro.css">
</head>

<body>
    <div id="contenido-comun">
    </div>
    <script src="nav_var.js" defer></script>
    
    <aside>
        
    <form action="procesar_formulario.php" method="post">
        <h2>Formulario de Registro de Bienes</h2>
        <label for="tipo_bien">Tipo de Bien:</label>
        <select name="tipo_bien" id="tipo_bien" required>
            <option value="mobiliario">Mobiliario</option>
            <option value="maquinaria">Maquinaria</option>
            <option value="informaticos">Equipos, Sistemas y Paquetes Informaticos</option>
            <option value="terreno">Terreno</option>
        </select>
        <label for="codigo">Código:</label>
        <input type="text" name="codigo" id="codigo" required>
        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" id="cantidad" required>
        <label for="descripcion">Descripción del Bien:</label>
        <textarea name="descripcion" id="descripcion" rows="4" cols="50" required></textarea>
        <label for="observacion">Observación:</label>
        <textarea name="observacion" id="observacion" rows="4" cols="50"></textarea>
        <label for="ubicacion">Ubicación:</label>
        <input type="text" name="ubicacion" id="ubicacion" required>
        <label for="fecha_adquisicion">Fecha de Adquisición:</label>
        <input type="date" name="fecha_adquisicion" id="fecha_adquisicion" required>
        <label for="numero_factura">Número de Factura:</label>
        <input type="text" name="numero_factura" id="numero_factura" required>
        <label for="total">Total:</label>
        <input type="text" name="total" id="total" step="0.01" required>
        <button type="submit">Registrar Bien</button>
    </form>
</aside>

</body>
</html>