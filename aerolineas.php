<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}

include 'conec.php';

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Error al conectar: " . $conn->connect_error);
}

$usuario_id = $_SESSION['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $sede = $_POST['sede'];
    $rol = 'Administrador';

    $sql = "INSERT INTO aerolineas (nombre, sede) VALUES ('$nombre', '$sede')";

    if ($conn->query($sql) === TRUE) {
        echo "Aerolínea creada exitosamente.";
    } else {
        echo "Error al crear aerolínea: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestión de Aerolíneas</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div>
        <h2>Crear Aerolínea</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="nombre">Nombre de la Aerolínea:</label>
            <input type="text" id="nombre" name="nombre" required><br>
            <label for="sede">Sede:</label>
            <input type="text" id="sede" name="sede" required><br>
            <input type="submit" value="Crear Aerolínea">
        </form>
    </div>
</body>
</html>
