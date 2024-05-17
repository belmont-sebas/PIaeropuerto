<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
    <link rel="stylesheet" type="text/css"  href="estilos.css" >
    <script src="js/funciones.js"></script>
<body>
<div>
        <h2>Registro</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return validateForm()">
            <label for="nombre">Nombre:</label><br>
            <input type="text" id="nombre" name="nombre" placeholder="Ingrese su nombre" required><br>
            <label for="correo">Correo:</label><br>
            <input type="text" id="correo" name="correo" placeholder="Ingrese su correo electrónico" required><br>

            <div class="password-container">
    <label for="contrasena">Contraseña:</label><br>
    <input type="password" id="contrasena" name="contrasena" placeholder="Ingrese su contraseña" required>
    <span class="toggle-password" onclick="togglePasswordVisibility('contrasena')">
        <img src="img/ojo.png" alt="Mostrar/Ocultar contraseña"> 
    </span>
</div><br>

<div class="password-container">
    <label for="confirmar_contrasena">Confirmar Contraseña:</label><br>
    <input type="password" id="confirmar_contrasena" name="confirmar_contrasena" placeholder="Confirme su contraseña" required>
    <span class="toggle-password" onclick="togglePasswordVisibility('confirmar_contrasena')">
        <img src="img/ojo.png" alt="Mostrar/Ocultar contraseña"> 
    </span>
</div><br>

            

            <input type="submit" value="Registrarse">
            <p>¿Ya tienes una cuenta? <a href="index.php">Iniciar Sesión</a></p>
        </form>
    </div>
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

