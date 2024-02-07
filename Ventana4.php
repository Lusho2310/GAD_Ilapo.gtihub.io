<?php
    include "mi_conexion.php";

    // Conectar a la base de datos
    $db = new Database();
    $con = $db->conectar();

    // Consultar los datos de la tabla
    $sql = $con->prepare("SELECT * FROM bienes");
    $sql->execute();
    $bienes = $sql->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <link rel="stylesheet" type="text/css" href="css/modificar.css">
    <title>Inventario</title>
    <script>
        function confirmarEliminacion(id) {
            var confirmacion = confirm("¿Estás seguro de que deseas eliminar este registro?");
            if (confirmacion) {
                window.location.href = "eliminar.php?id=" + id;
            }
        }
    </script>
</head>
<body>
    <div id="contenido-comun"></div>
    <script src="nav_var.js" defer></script>
    
    <div>
        <h1>Lista de Bienes Registrados</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Tipo de Bien</th>
                    <th>Código</th>
                    <th>Cantidad</th>
                    <th>Descripción</th>
                    <th>Observación</th>
                    <th>Ubicación</th>
                    <th>Fecha de Adquisición</th>
                    <th>Número de Factura</th>
                    <th>Total</th>
                    <th>Acciones</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bienes as $bien): ?>
                    <tr>
                        <td><?php echo $bien['tipo_bien']; ?></td>
                        <td><?php echo $bien['codigo']; ?></td>
                        <td><?php echo $bien['cantidad']; ?></td>
                        <td><?php echo $bien['descripcion']; ?></td>
                        <td><?php echo $bien['observacion']; ?></td>
                        <td><?php echo $bien['ubicacion']; ?></td>
                        <td><?php echo $bien['fecha_adquisicion']; ?></td>
                        <td><?php echo $bien['numero_factura']; ?></td>
                        <td><?php echo $bien['total']; ?></td>
                        <td>
                        <button onclick="window.location.href='modificar.php?id=<?php echo $bien['id']; ?>'" class="btn-modificar">Modificar</button>
                        <button onclick="confirmarEliminacion(<?php echo $bien['id']; ?>)" class="btn-eliminar">Eliminar</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
