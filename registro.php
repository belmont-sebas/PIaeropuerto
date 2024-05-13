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
    $rol = 'Pasajero'; // Por defecto se registra como Pasajero

    $sql = "INSERT INTO Usuarios (nombre, correo, contrasena, rol) VALUES ('$nombre', '$correo', '$contrasena', '$rol')";

    if ($conn->query($sql) === TRUE) {
        echo "Registro exitoso. Ahora puedes iniciar sesión.";
    } else {
        echo "Error al registrar: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div>
    <h2>Registro</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" placeholder="Ingrese su nombre"><br>
        <label for="correo">Correo:</label><br>
        <input type="text" id="correo" name="correo" placeholder="Ingrese su correo electrónico"><br>
        <label for="contrasena">Contraseña:</label><br>
        <input type="password" id="contrasena" name="contrasena" placeholder="Ingrese su contraseña"><br><br>
        <input type="submit" value="Registrarse">
        <p>¿ya tienes una cuenta? <a href="index.php">Iniciar Sesión</a></p>
    </form>
    </div>
</body>
</html>
