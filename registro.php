<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
    <link rel="stylesheet"  href="estilos.css" type="text/css">
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("contrasena");
            var confirmPasswordInput = document.getElementById("confirmar_contrasena");
            var passwordType = passwordInput.type;
            var confirmPasswordType = confirmPasswordInput.type;

            if (passwordType === "password") {
                passwordInput.type = "text";
                confirmPasswordInput.type = "text";
            } else {
                passwordInput.type = "password";
                confirmPasswordInput.type = "password";
            }
        }

        

        function validateForm() {
            var nombre = document.getElementById("nombre").value.trim();
            var correo = document.getElementById("correo").value.trim();
            var contrasena = document.getElementById("contrasena").value.trim();
            var confirmar_contrasena = document.getElementById("confirmar_contrasena").value.trim();

            var errorMessage = "";

            if (nombre === "") {
                errorMessage += "Por favor, ingrese su nombre.\n";
            }

            if (correo === "") {
                errorMessage += "Por favor, ingrese su correo electrónico.\n";
            } else if (!validateEmail(correo)) {
                errorMessage += "Por favor, ingrese un correo electrónico válido.\n";
            }

            if (contrasena === "") {
                errorMessage += "Por favor, ingrese una contraseña.\n";
            }

            if (confirmar_contrasena === "") {
                errorMessage += "Por favor, confirme su contraseña.\n";
            }

            if (errorMessage !== "") {
                alert(errorMessage);
                return false;
            }

            return true;
        }

        function validateEmail(email) {
            const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        }
    </script>
</head>
<body>
<div class="container">
        <div class="logo-container">
            <img src="img/log.png" alt="Logo de la aerolínea"> <!-- Aquí se enlaza el log.png -->
        </div>
        
    <div>
    <h2>Registro</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return validateForm()">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" placeholder="Ingrese su nombre" required><br>
        <label for="correo">Correo:</label><br>
        <input type="text" id="correo" name="correo" placeholder="Ingrese su correo electrónico" required><br>
        <label for="contrasena">Contraseña:</label><br>
        <input type="password" id="contrasena" name="contrasena" placeholder="Ingrese su contraseña" required><br>
        <label for="confirmar_contrasena">Confirmar Contraseña:</label><br>
        <input type="password" id="confirmar_contrasena" name="confirmar_contrasena" placeholder="Confirme su contraseña" required>
        <p> Mostrar contraseña</p>
        <input type="checkbox" onclick="togglePasswordVisibility()"><br><br>
        <input type="submit" value="Registrarse">
        <p>¿ya tienes una cuenta? <a href="index.php">Iniciar Sesión</a></p>
    </form>
    </div>

    <style>
        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo-container img {
            max-width: 200px; /* Ajusta el tamaño máximo del logo según sea necesario */
            height: auto;
        }

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include'conec.php';

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Error al conectar: " . $conn->connect_error);
        }

        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $contrasena = $_POST['contrasena'];
        $confirmar_contrasena = $_POST['confirmar_contrasena'];
        $rol = 'Pasajero'; // Por defecto se registra como Pasajero

        if ($contrasena === $confirmar_contrasena) {
            $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);
            $sql = "INSERT INTO Usuarios (nombre, correo, contrasena, rol) VALUES ('$nombre', '$correo', '$hashed_password', '$rol')";

            if ($conn->query($sql) === TRUE) {
                echo "<div class='success-message'>Registro exitoso. Ahora puedes iniciar sesión.</div>";
            } else {
                echo "<div class='error-message'>Error al registrar: " . $conn->error . "</div>";
            }
        } else {
            echo "<div class='error-message'>Las contraseñas no coinciden.</div>";
        }

        $conn->close();
    }
    ?>

</body>
</html>

