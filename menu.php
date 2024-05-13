<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}

$rol = $_SESSION['rol'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Menú</title>
    <link rel="stylesheet"  href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Menú</h2>
        <ul>
            <li><a href="vuelos.php" class="button">Ver Vuelos</a></li>
            <?php if ($rol == 'Administrador') { ?>
                <li><a href="crear_vuelo.php" class="button">Crear Vuelo</a></li>
                <li><a href="gestionar_usuarios.php" class="button">Gestionar Usuarios</a></li>
            <?php } ?>
            <li><a href="perfil.php" class="button">Ver Perfil</a></li>
            <li><a href="index.php" class="button">Cerrar Sesión</a></li>
        </ul>
    </div>
</body>
</html>
