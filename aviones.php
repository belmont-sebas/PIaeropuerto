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
    if (isset($_POST['crear_avion'])) {
        $modelo = $_POST['modelo'];
        $aerolinea_id = $_POST['aerolinea_id'];

        $stmt = $conn->prepare("INSERT INTO Aviones (modelo, aerolinea_id) VALUES (?, ?)");
        $stmt->bind_param("si", $modelo, $aerolinea_id);

        if ($stmt->execute()) {
            echo "<div class='success-message'>Avión creado exitosamente.</div>";
        } else {
            echo "<div class='error-message'>Error al crear avión: " . $stmt->error . "</div>";
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
    <title>Gestión de Aviones</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
    <div class="container">
        <h2>Crear Avión</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="modelo">Modelo del Avión:</label>
            <input type="text" name="modelo" required><br>
            <label for="aerolinea_id">Aerolínea:</label>
            <select name="aerolinea_id" required>
            <option value=""></option>
                <?php generarOpcionesAerolineas($conn); ?>
            </select><br>
            <button type="submit" name="crear_avion">Crear Avión</button>
        </form>
        <br>
        <a href="menu.php">
            <button>Regresar</button>
        </a>
    </div>
</body>
</html>
