<?php
include 'conec.php'; // Asegúrate de que 'conec.php' tenga la conexión a la base de datos correcta
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Error al conectar: " . $conn->connect_error);
}
// Verificar si se recibió el ID de la aerolínea
if (isset($_POST['aerolinea_id'])) {
    $aerolineaId = $_POST['aerolinea_id'];

    // Validar que el ID de la aerolínea sea un número entero
    if (!filter_var($aerolineaId, FILTER_VALIDATE_INT)) {
        echo json_encode(['error' => 'ID de aerolínea inválido']);
        exit; // Detener la ejecución si el ID no es válido
    }

    // Obtener pilotos y aviones según la aerolínea seleccionada (usando consultas preparadas para mayor seguridad)
    $sqlPilotos = "SELECT id, nombre FROM Pilotos WHERE aerolinea_id = ?";
    $stmtPilotos = $conn->prepare($sqlPilotos);
    $stmtPilotos->bind_param("i", $aerolineaId);
    $stmtPilotos->execute();
    $resultPilotos = $stmtPilotos->get_result();

    $sqlAviones = "SELECT id, modelo FROM Aviones WHERE aerolinea_id = ?";
    $stmtAviones = $conn->prepare($sqlAviones);
    $stmtAviones->bind_param("i", $aerolineaId);
    $stmtAviones->execute();
    $resultAviones = $stmtAviones->get_result();

    $pilotos = [];
    while ($row = $resultPilotos->fetch_assoc()) {
        $pilotos[$row['id']] = $row['nombre'];
    }

    $aviones = [];
    while ($row = $resultAviones->fetch_assoc()) {
        $aviones[$row['id']] = $row['modelo'];
    }

    // Enviar los datos en formato JSON
    $response = [
        'pilotos' => generarOpciones($pilotos, "Selecciona un piloto"),
        'aviones' => generarOpciones($aviones, "Selecciona un avión"),
    ];
    echo json_encode($response);
} else {
    echo json_encode(['error' => 'Falta el ID de la aerolínea']);
}

// Función auxiliar para generar opciones en los <select> (sin cambios)
function generarOpciones($datos, $mensajePlaceholder = "") {
    $options = "";
    if (!empty($datos)) {
        foreach ($datos as $id => $valor) {
            $options .= "<option value='$id'>$valor</option>";
        }
    } else {
        $options .= "<option value=''>$mensajePlaceholder</option>";
    }
    return $options;
}
?>

