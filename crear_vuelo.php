<?php
include 'conec.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $piloto = $_POST['piloto'];
    $avion = $_POST['avion'];
    $origen = $_POST['origen'];
    $destino = $_POST['destino'];

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Error al conectar: " . $conn->connect_error);
    }

    $sql = "INSERT INTO Vuelos (fecha, hora, piloto, avion, origen, destino) VALUES ('$fecha', '$hora', '$piloto', '$avion', '$origen', '$destino')";

    if ($conn->query($sql) === TRUE) {
        echo "Vuelo creado exitosamente.";
    } else {
        echo "Error al crear vuelo: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Crear Vuelo</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div>
        <h2>Crear Nuevo Vuelo</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" required><br>
            <label for="hora">Hora:</label>
            <input type="time" id="hora" name="hora" required><br>
            <label for="piloto">Piloto:</label>
            <input type="text" id="piloto" name="piloto" required><br>
            <label for="avion">Avión:</label>
            <input type="text" id="avion" name="avion" required><br>
            <label for="origen">Origen:</label>
            <input type="text" id="origen" name="origen" required><br>
            <label for="destino">Destino:</label>
            <input type="text" id="destino" name="destino" required><br>
            <input type="submit" value="Crear Vuelo">
        </form>
    </div>
</body>
</html>
