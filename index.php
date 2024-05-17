<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include 'conec.php';

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Error al conectar: " . $conn->connect_error);
  }

  $correo = $_POST['correo'];
  $contrasena = $_POST['contrasena'];

  $sql = "SELECT id, nombre, rol, contrasena FROM Usuarios WHERE correo = '$correo'";
  $result = $conn->query($sql);

  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $hashed_password = $row['contrasena'];

    if (password_verify($contrasena, $hashed_password)) {
      $_SESSION['id'] = $row['id'];
      $_SESSION['nombre'] = $row['nombre'];
      $_SESSION['rol'] = $row['rol'];
      header("Location: menu.php");
    } else {
      echo "Credenciales incorrectas. Por favor, inténtalo de nuevo.";
    }
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
    <link rel="stylesheet" type="text/css" href="estilos.css">
    <script src="js/funciones.js"></script>
</head>
<body>
    <div>
        <h2>Iniciar Sesión</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="correo">Correo:</label><br>
            <input type="text" id="correo" name="correo" placeholder="Ingrese su correo electrónico"><br>

            <div class="password-container">  
                <label for="contrasena">Contraseña:</label><br>
                <input type="password" id="contrasena" name="contrasena" placeholder="Ingrese su contraseña">
                <span class="toggle-password" onclick="togglePasswordVisibility('contrasena')">
                <img src="img/ojo.png" alt="Mostrar/Ocultar contraseña"> 
                </span>
            </div>
            <br>

            <input type="submit" value="Iniciar Sesión">
            <p>¿No tienes una cuenta? <a href="registro.php">Registrarse</a></p>
        </form>
    </div>

</body>
</html>