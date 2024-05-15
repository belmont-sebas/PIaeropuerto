<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}

include 'conec.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error al conectar: " . $conn->connect_error);
}

$usuario_id = $_SESSION['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contrasena_actual = $_POST['contrasena_actual'];
    $nueva_contrasena = $_POST['nueva_contrasena'];

    $sql = "SELECT contrasena FROM Usuarios WHERE id = '$usuario_id'";
    $result = $conn->query($sql);
    $usuario = $result->fetch_assoc();

    if ($usuario['contrasena'] == $contrasena_actual) {
        $sql = "UPDATE Usuarios SET nombre = '$nombre', correo = '$correo', contrasena = '$nueva_contrasena' WHERE id = '$usuario_id'";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['nombre'] = $nombre;
            echo "Perfil actualizado exitosamente.";
        } else {
            echo "Error al actualizar perfil: " . $conn->error;
        }
    } else {
        echo "La contraseña actual no es válida.";
    }
}

$sql = "SELECT * FROM Usuarios WHERE id = '$usuario_id'";
$result = $conn->query($sql);
$usuario = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Perfil</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
    <div class="container">
        <h2>Editar Perfil</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $usuario['nombre']; ?>" required><br>
            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" value="<?php echo $usuario['correo']; ?>" required><br>
            <label for="contrasena_actual">Contraseña actual:</label>
            <input type="password" id="contrasena_actual" name="contrasena_actual" required><br>
            <label for="nueva_contrasena">Nueva contraseña:</label>
            <input type="password" id="nueva_contrasena" name="nueva_contrasena"><br>
            <input type="submit" value="Actualizar Perfil">
        </form>
        <a href="menu.php">
            <button>Regresar</button>
        </a>
    </div>
</body>
</html>
