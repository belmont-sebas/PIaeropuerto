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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['actualizar_piloto'])) {
        $id_piloto = $_POST['id_piloto'];
        $nombre = $_POST['nombre'];
        $informacion_personal = $_POST['informacion_personal'];
        $aerolinea_id = $_POST['aerolinea_id'];
        $sql = "SELECT nombre FROM pilotos WHERE id = '$nombre'";
        $result = $conn->query($sql);
        $usuario = $result->fetch_assoc();

        $stmt = $conn->prepare("UPDATE Pilotos SET nombre = ?, informacion_personal = ?, aerolinea_id = ? WHERE id = ?");
        $stmt->bind_param("ssii", $usuario['nombre'], $informacion_personal, $aerolinea_id, $nombre);

        if ($stmt->execute()) {
            echo "<div class='success-message'>Piloto actualizado exitosamente.</div>";
        } else {
            echo "<div class='error-message'>Error al actualizar piloto: " . $stmt->error . "</div>";
        }
    }
}

function generarOpcionesUsuarios($conn) {
    $sql = "SELECT id, nombre FROM Pilotos";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
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
        <h2>Actualizar Piloto</h2>
        <div class="logo-container">
         <img src="img/piloto.png" alt="Logo de la aerolínea"> 
    </div>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="id_piloto">
            <label for="nombre">Nombre del Piloto:</label>
            <select name="nombre" required>
                <?php generarOpcionesUsuarios($conn); ?>
            </select><br>
            <label for="informacion_personal">Información Personal:</label>
            <input type="text" name="informacion_personal" required><br>
            <label for="aerolinea_id">Aerolínea:</label>
            <select name="aerolinea_id" required>
            <option value=""></option>
                <?php generarOpcionesAerolineas($conn); ?>
            </select><br>
            <button type="submit" name="actualizar_piloto">Actualizar Piloto</button>
        </form>
        <br>
        <a href="menu.php">
            <button>Regresar</button>
        </a>
    </div>
</body>
</html>
