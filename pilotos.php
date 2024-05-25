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
    if (isset($_POST['crear_piloto'])) {
        $nombre = $_POST['nombre'];
        $informacion_personal = $_POST['informacion_personal'];
        $aerolinea_id = $_POST['aerolinea_id'];

        $stmt = $conn->prepare("INSERT INTO Pilotos (nombre, informacion_personal, aerolinea_id) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $nombre, $informacion_personal, $aerolinea_id);

        if ($stmt->execute()) {
            echo "<div class='success-message'>Piloto creado exitosamente.</div>";
        } else {
            echo "<div class='error-message'>Error al crear piloto: " . $stmt->error . "</div>";
        }
    }
}


function generarOpcionesAerolineas($conn) {
    $sql = "SELECT nit, nombre FROM Aerolineas";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['nit'] . "'>" . $row['nombre'] . "</option>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Gestión de Pilotos</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
    <div class="container">
    <div class="logo-container">
         <img src="img/piloto.png" alt="Logo de la aerolínea"> 
    </div>
        <h2>Crear/Actualizar Piloto</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="nombre">Nombre:</label><br>
            <input type="text" name="nombre" placeholder="Ingrese su nombre" required><br>
            <label for="informacion_personal">Información Personal:</label>
            <input type="text" name="informacion_personal" placeholder="Ingrese informacion personal" required><br>
            <label for="aerolinea_id">Aerolínea:</label>
            <select name="aerolinea_id" required>
            <option value=""></option>
                <?php generarOpcionesAerolineas($conn); ?>
            </select><br>
            <button type="submit" name="crear_piloto">Crear Piloto</button>
        </form>
        <br>
        <a href="ac_pilotos.php">
            <button>Actualizar piloto</button>
        </a> 
        <a href="menu.php">
            <button>Regresar</button>
        </a>
    </div>
</body>
</html>

