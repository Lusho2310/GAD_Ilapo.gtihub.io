<?php
session_start();
include "mi_conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $password = $_POST['password'];

    $db = new Database();
    $con = $db->conectar();

    // Consulta para obtener el usuario por nombre de usuario o email
    $sql = $con->prepare("SELECT * FROM users WHERE fullname = ? OR email = ?");
    $sql->execute([$fullname, $fullname]);
    $user = $sql->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Verificar la contraseña
        if (password_verify($password, $user['password'])) {
            // Iniciar sesión
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fullname'] = $user['fullname'];
            header("Location: inicio.php"); // Redirigir al dashboard o página de inicio
            exit();
        } else {
            echo "Credenciales incorrectas";
        }
    } else {
        echo "Usuario no encontrado";
    }
}
?>