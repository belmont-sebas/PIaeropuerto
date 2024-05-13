<?php
include 'conec.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error al conectar: " . $conn->connect_error);
}

$vuelo_id = $_GET['vuelo_id'];

// Consulta para obtener los detalles del vuelo
$sql = "SELECT * FROM Vuelos WHERE id = '$vuelo_id'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detalles del Vuelo</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Detalles del Vuelo</h2>
        <?php
        if ($result->num_rows > 0) {
            $vuelo = $result->fetch_assoc();
            ?>
            <p>Fecha: <?php echo $vuelo['fecha']; ?></p>
            <p>Hora: <?php echo $vuelo['hora']; ?></p>
            <p>Origen: <?php echo $vuelo['origen']; ?></p>
            <p>Destino: <?php echo $vuelo['destino']; ?></p>
            <p>Precio: <?php echo $vuelo['precio']; ?></p>
            <form method="post" action="procesar_compra.php">
                <input type="hidden" name="vuelo_id" value="<?php echo $vuelo_id; ?>">
                <input type="submit" value="Comprar">
            </form>
            <a href="vuelos.php">
                <button>Regresar</button>
            </a>
            <?php
        } else {
            echo "<p>No se encontró el vuelo seleccionado.</p>";
        }
        ?>
    </div>
</body>
</html>
<?php
$conn->close();
?>
