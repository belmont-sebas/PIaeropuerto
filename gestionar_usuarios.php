<?php
include 'conec.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $rol = $_POST['rol'];

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Error al conectar: " . $conn->connect_error);
    }

    $sql = "INSERT INTO Usuarios (nombre, correo, contrasena, rol) VALUES ('$nombre', '$correo', '$contrasena', '$rol')";

    if ($conn->query($sql) === TRUE) {
        echo "Usuario creado exitosamente.";
    } else {
        echo "Error al crear usuario: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Crear Usuario</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
    <div class="container">
        <h2>Crear Nuevo Usuario</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required><br>
            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" required><br>
            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required><br>
            <label for="rol">Rol:</label>
            <select id="rol" name="rol">
                <option value="Administrador">Administrador</option>
                <option value="Usuario">Pasajero</option>
            </select><br>
            <input type="submit" value="Crear Usuario">
        </form>
        <br>
        <a href="menu.php">
            <button>Regresar</button>
        </a>
    </div>
</body>
</html>
