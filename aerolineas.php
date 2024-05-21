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
    $sede = $_POST['sede'];
    $nit = $_POST['nit'];
    $rol = 'Administrador';

    $sql = "INSERT INTO aerolineas (nombre, sede) VALUES ('$nombre', '$sede', '$nit')";  

    $sql_check = "SELECT id FROM aerolineas WHERE nit = '$nit'";
    $result_check = $conn->query($sql_check);
    
    if ($result_check->num_rows > 0) {
        echo "Ya existe una aerolínea con ese NIT.";
    } else {
        // Insertar los datos en la base de datos
        $sql_insert = "INSERT INTO aerolineas (nombre, sede, nit) VALUES ('$nombre', '$sede', '$nit')";
        
        if ($conn->query($sql_insert) === TRUE) {
            echo "Aerolínea creada exitosamente.";
        } else {
            echo "Error al crear aerolínea: " . $conn->error;
        }
    }
    

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
    <link rel="stylesheet" type="text/css" href="estilos.css">
    <style>
        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo-container img {
            max-width: 200px; /* Ajusta el tamaño máximo del logo según sea necesario */
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo-container">
            <img src="img/logo.png" alt="Logo de la aerolínea"> <!-- Aquí se enlaza el logo.png -->
        </div>
        <h2>Crear Aerolínea</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="nombre">Nombre de la Aerolínea:</label>
            <input type="text" id="nombre" name="nombre" required><br>
            <label for="sede">Sede:</label>
            <input type="text" id="sede" name="sede" required><br>
            <label for="nit">NIT de la Aerolínea:</label>
            <input type="text" id="nit" name="nit" required><br> <!-- Nuevo campo NIT -->
            <input type="submit" value="Crear Aerolínea">
        </form>   
        <a href="menu.php">
            <button>Regresar</button>
        </a>   
    </div>
</body>
</html>

