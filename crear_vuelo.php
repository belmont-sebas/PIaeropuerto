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

// Obtener aerolíneas desde la base de datos (usando ID)
$sqlAerolineas = "SELECT nit, nombre FROM Aerolineas";
$resultAerolineas = $conn->query($sqlAerolineas);
$aerolineas = [];
while ($row = $resultAerolineas->fetch_assoc()) {
    $aerolineas[$row['nit']] = $row['nombre'];
}

// Variables para almacenar los datos de pilotos y aviones
$pilotos = [];
$aviones = [];

// Obtener pilotos y aviones si se ha seleccionado una aerolínea
if (isset($_POST['aerolinea'])) {
    $aerolineaId = $_POST['aerolinea'];

    // Obtener pilotos (usando ID)
    $sqlPilotos = "SELECT id, nombre FROM pilotos WHERE aerolinea_id = '$aerolineaId'";
    $resultPilotos = $conn->query($sqlPilotos);
    while ($row = $resultPilotos->fetch_assoc()) {
        $pilotos[$row['id']] = $row['nombre'];
    }

    // Obtener aviones
    $sqlAviones = "SELECT id, modelo FROM aviones WHERE aerolinea_id = '$aerolineaId'";
    $resultAviones = $conn->query($sqlAviones);
    while ($row = $resultAviones->fetch_assoc()) {
        $aviones[$row['id']] = $row['modelo'];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['fecha'], $_POST['hora'], $_POST['piloto'], $_POST['avion'], $_POST['origen'], $_POST['destino'])) {
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $pilotoId = $_POST['piloto'];
    $avionId = $_POST['avion'];
    $origen = $_POST['origen'];
    $destino = $_POST['destino'];

    $sqlInsertVuelo = "INSERT INTO Vuelos (fecha, hora, piloto_id, avion_id, origen, destino) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sqlInsertVuelo);
    $stmt->bind_param("ssisss", $fecha, $hora, $pilotoId, $avionId, $origen, $destino);

    if ($stmt->execute()) {
        echo "Vuelo creado exitosamente.";
    } else {
        echo "Error al crear el vuelo: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Crear Vuelo</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#aerolinea").change(function() {
                var aerolineaId = $(this).val();
                $.ajax({
                    url: "obtener_datos.php",
                    method: "POST",
                    data: { aerolinea_id: aerolineaId },
                    dataType: "json",
                    success: function(data) {
                        $("#piloto").html(data.pilotos);
                        $("#avion").html(data.aviones);
                    },
                    error: function() {
                        alert("Error al cargar pilotos y aviones.");
                    }
                });
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <br><br><br><br><br><br><br>
        <div class="logo-container">
            <img src="img/logcrvuelo.png" alt="Logo de la aerolínea"> 
        </div>
        <h2>Crear Nuevo Vuelo</h2>
        <form id="formVuelo" method="post"> 
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" required><br>
            <label for="hora">Hora:</label>
            <input type="time" id="hora" name="hora" required><br>
            <label for="aerolinea">Aerolínea:</label>
            <select id="aerolinea" name="aerolinea" required>
                <?php
                foreach ($aerolineas as $nit => $nombre) {
                    echo "<option value='$nit'>$nombre</option>";
                }
                ?>
            </select><br>
            <label for="piloto">Piloto:</label>
            <select id="piloto" name="piloto" required>
                <option value="">Selecciona un piloto</option> 
                <?php
                if (!empty($pilotos)) {
                    foreach ($pilotos as $id => $nombre) {
                        echo "<option value='$id'>$nombre</option>";
                    }
                }
                ?>
            </select><br>
            <label for="avion">Avión:</label>
            <select id="avion" name="avion" required>
                <option value="">Selecciona un avión</option>
                <?php
                if (!empty($aviones)) {
                    foreach ($aviones as $id => $modelo) {
                        echo "<option value='$id'>$modelo</option>";
                    }
                }
                ?>
            </select><br>
            <label for="origen">Origen:</label>
            <input type="text" id="origen" name="origen" required><br>
            <label for="destino">Destino:</label>
            <input type="text" id="destino" name="destino" required><br>
            <button type="submit">Crear Vuelo</button>
        </form>
        <a href="menu.php"><button>Regresar</button></a>
    </div>
</body>
</html>
