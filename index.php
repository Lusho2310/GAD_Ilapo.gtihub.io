<?php 
    include "mi_conexion.php";

    

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $db = new Database();
    $con = $db->conectar();
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
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario</title>
    <link rel="stylesheet" type="text/css" href="css/ingreso.css">
</head>

<body>
<div class="img-container">
        <div class="image-overlay"></div>
        <img src="img_ch.jpeg" alt="fondo" class="background-image">
    </div>

    <div id="cuadro">
    </div>
    <div class="main-container">
        <div class="container">
            <div class="left">
                <img src="img-personaPC.jpeg" alt="personaPC" class="persona-image">
            </div>
            <div class="right">
                <div class="tab-container">
                    <button class="tab" onclick="showTab('login')">Ingresar</button>
                    <button class="tab" onclick="showTab('register')">Registrarse</button>
                </div>
                <br>
                <br>
                <br>
                <div class="disenio3">
                    <br>
                </div>
                <div class="disenio4">
                    <br>
                </div>
                <div class="login-container" id="loginTab">
                    <br>
                    <h2>Ingrese su cuenta</h2>
                    <form action="login.php" method="post">
        <input type="text" name="fullname" placeholder="Nombre de usuario o email" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit" class="boton_inicio">Iniciar sesión</button>
        <a href="#" class="olvide_contrasena" onclick="showPasswordRecovery()">Olvidé mi Contraseña</a>
    </form>
                </div>
                <div class="register-container" id="registerTab">
                    <h1>Registrarse</h1>
                    <form action="conexion_be.php" method="post">
    <input type="text" name="fullname" placeholder="Nombre completo" required>
    <input type="email" name="email" placeholder="Correo electrónico" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    <button type="submit" class="boton_regis">Registrarse</button>
</form>
                </div>
            </div>
        </div>
    </div>


    

    <!-- Script para cambiar entre pestañas de inicio de sesión y registro -->
    <script>
        function showTab(tabName) {
            var loginTab = document.getElementById('loginTab');
            var registerTab = document.getElementById('registerTab');

            if (tabName === 'login') {
                loginTab.style.display = 'block';
                registerTab.style.display = 'none';
            } else if (tabName === 'register') {
                loginTab.style.display = 'none';
                registerTab.style.display = 'block';
            }
        }

        // Función para manejar el inicio de sesión (verificación simple para pruebas)
        function handleLogin() {
            var username = document.getElementsByName('username')[0].value;
            var password = document.getElementsByName('password')[0].value;

            if (username === '123' && password === '123') {
                window.location.href = 'index.html';
                return false;
            } else {
                alert('Credenciales incorrectas');
                return false;
            }
        }

        // Mostrar la pestaña de inicio de sesión al cargar la página
        document.addEventListener('DOMContentLoaded', function () {
            showTab('login');
        });

        // Función para mostrar la ventana emergente de recuperación de contraseña
        function showPasswordRecovery() {
            document.getElementById('overlay').style.display = 'flex';
        }

        // Función para cerrar la ventana emergente
        function closePopup() {
            document.getElementById('overlay').style.display = 'none';
        }

        // Función para verificar la recuperación de contraseña (simulación)
        function verify() {
            alert('Función de verificación');
        }


        //Enviar a inicio
        function handleLogin() {
            var username = document.getElementsByName('username')[0].value;
            var password = document.getElementsByName('password')[0].value;

            if (username === '123' && password === '123') {
                window.location.href = 'index.html';
                return false;
            } else {
                alert('Credenciales incorrectas');
                return false;
            }
        }
    </script>

    <!-- Ventana emergente para recuperación de contraseña -->
    <div class="overlay" id="overlay" onclick="closePopup()">
        <div class="popup" id="popup" onclick="event.stopPropagation();">
            <div class="popup-header">
                <h2>Recuperación de Contraseña</h2>
            </div>
            <form>
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" required>
                <div class="botones_emergente">
                    <button type="button" class="close-button" onclick="verify()">Verificar</button>
                    <button type="button" class="close-button" onclick="closePopup()">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
