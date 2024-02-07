<?php
include "mi_conexion.php";

// Verificar si se proporcionó un ID válido
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Conectar a la base de datos
    $db = new Database();
    $con = $db->conectar();

    // Obtener el ID del registro a eliminar
    $id = $_GET['id'];

    // Preparar la consulta SQL para eliminar el registro
    $sql = $con->prepare("DELETE FROM bienes WHERE id = ?");
    
    // Ejecutar la consulta
    $sql->execute([$id]);

    // Redirigir a la página de inventario después de eliminar el registro
    header("Location: Inventario.php");
    exit();
} else {
    // Si no se proporcionó un ID válido, redirigir a la página de inventario
    header("Location: Inventario.php");
    exit();
}
?>