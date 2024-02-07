<?php
include "mi_conexion.php";

$db = new Database();
$con = $db->conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['password'])){
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (!empty($fullname) && !empty($email) && !empty($password)) {
            // Verifica si el usuario ya existe en la base de datos
            $sql = $con->prepare("SELECT * FROM users WHERE fullname = ?");
            $sql->execute([$fullname]);
            $existingUser = $sql->fetch(PDO::FETCH_ASSOC);

            if ($existingUser) {
                echo "El nombre de usuario ya está en uso";
            } else {
                // Inserta el nuevo usuario en la base de datos
                $sql = $con->prepare("INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)");
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                if ($sql->execute([$fullname, $email, $hashedPassword])) {
                    echo "Usuario registrado exitosamente";
                } else {
                    echo "Error al registrar el usuario";
                }
            }
        } else {
            echo "Por favor, complete todos los campos del formulario.";
        }
    } else {
        echo "No se recibieron todos los datos del formulario.";
    }
}
?>
