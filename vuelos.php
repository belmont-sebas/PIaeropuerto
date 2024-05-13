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
    $fecha_consulta = $_POST['fecha'];
    $origen_consulta = $_POST['origen'];
    $destino_consulta = $_POST['destino'];

    $sql = "SELECT * FROM Vuelos WHERE fecha = '$fecha_consulta'";

    if (!empty($origen_consulta) && empty($destino_consulta)) {
        $sql .= " AND (origen = '$origen_consulta' OR destino = '$origen_consulta')";
    } elseif (empty($origen_consulta) && !empty($destino_consulta)) {
        $sql .= " AND (origen = '$destino_consulta' OR destino = '$destino_consulta')";
    } elseif (!empty($origen_consulta) && !empty($destino_consulta)) {
        $sql .= " AND (origen = '$origen_consulta' OR destino = '$origen_consulta' OR origen = '$destino_consulta' OR destino = '$destino_consulta')";
    }

    $sql .= " ORDER BY hora";
} else {
    $sql = "SELECT * FROM Vuelos WHERE fecha >= CURDATE() ORDER BY fecha, hora";
}

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Consulta de Vuelos</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Consulta de Vuelos</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="fecha">Consultar vuelos para la fecha:</label>
            <input type="date" id="fecha" name="fecha">
            <label for="origen">Ciudad de origen:</label>
            <input type="text" id="origen" name="origen">
            <label for="destino">Ciudad de destino:</label>
            <input type="text" id="destino" name="destino">
            <input type="submit" value="Consultar">
        </form>
        <table>
            <tr>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Origen</th>
                <th>Destino</th>
                <th>Acciones</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['fecha'] . "</td>";
                    echo "<td>" . $row['hora'] . "</td>";
                    echo "<td>" . $row['origen'] . "</td>";
                    echo "<td>" . $row['destino'] . "</td>";
                    echo "<td><a href='comprar_vuelo.php?vuelo_id=" . $row['id'] . "'>Comprar</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No se encontraron vuelos disponibles para los criterios seleccionados.</td></tr>";
            }
            ?>
        </table>
        <br>
        <a href="menu.php">
            <button>Regresar</button>
        </a>
    </div>
</body>
</html>

