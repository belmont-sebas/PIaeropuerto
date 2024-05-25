<!DOCTYPE html>
<html>
<head>
    <title>Crear Usuario</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
    <script src="js/funciones.js"></script>
</head>
<body>
    <div class="container">
    <div class="logo-container">
         <img src="img/logadmin.png" alt="Logo de la aerolínea"> 
    </div>
        <h2>Crear Nuevo Usuario</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" placeholder="Ingrese su nombre" required>
        <label for="correo">Correo:</label>
        <input type="text" id="correo" name="correo" placeholder="Ingrese su correo electrónico" required>
            <div class="password-container">  
                <label for="contrasena">Contraseña:</label><br>
                <input type="password" id="contrasena" name="contrasena" placeholder="Ingrese su contraseña">
                <span class="toggle-password" onclick="togglePasswordVisibility('contrasena')">
                <img src="img/ojo.png" alt="Mostrar/Ocultar contraseña"> 
                </span>
        </div>
        <div class="password-container">  
            <label for="confirmar_contrasena">Confirmar Contraseña:</label><br>
            <input type="password" id="confirmar_contrasena" name="confirmar_contrasena" placeholder="Confirme su contraseña" required>
            <span class="toggle-password" onclick="togglePasswordVisibility('confirmar_contrasena')">
            <img src="img/ojo.png" alt="Mostrar/Ocultar contraseña"> 
            </span>
        </div>
            <label for="rol">Rol:</label>
            <select id="rol" name="rol">
                <option value="Administrador">Administrador</option>
                <option value="Usuario">Pasajero</option>
            </select>
            <input type="submit" value="Crear Usuario">
            <?php
include 'conec.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $confirmar_contrasena = $_POST['confirmar_contrasena'];
    $rol = $_POST['rol'];

    $conn = new mysqli($servername, $username, $password, $dbname);

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
        </form>
        <a href="menu.php">
                 <button>Regresar</button>
        </a>  
    </div>
</body>
</html>
