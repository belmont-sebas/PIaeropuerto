<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   include'conec.php';

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Error al conectar: " . $conn->connect_error);
    }


    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    $sql = "SELECT id, nombre, rol FROM Usuarios WHERE correo = '$correo' AND contrasena = '$contrasena'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['id'] = $row['id'];
        $_SESSION['nombre'] = $row['nombre'];
        $_SESSION['rol'] = $row['rol'];
        header("Location: menu.php");
    } else {
        echo "Credenciales incorrectas. Por favor, inténtalo de nuevo.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sesión</title>
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="correo">Correo:</label><br>
        <input type="text" id="correo" name="correo"><br>
        <label for="contrasena">Contraseña:</label><br>
        <input type="password" id="contrasena" name="contrasena"><br><br>
        <input type="submit" value="Iniciar Sesión">
    </form>
</body>
</html>
