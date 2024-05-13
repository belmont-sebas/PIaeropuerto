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
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Bienvenido, <?php echo $_SESSION['nombre']; ?></h2>
        <h3>Menú</h3>
        <ul>
            <li><a href="vuelos.php">Ver Vuelos</a></li>
            <?php if ($rol == 'Administrador') { ?>
                <li><a href="crear_vuelo.php">Crear Vuelo</a></li>
                <li><a href="gestionar_usuarios.php">Gestionar Usuarios</a></li>
            <?php } ?>
            <li><a href="perfil.php">Ver Perfil</a></li>
            <li><a href="index.php">Cerrar Sesión</a></li>
        </ul>
        <?php if ($rol == 'Administrador') { ?>
            <div class="admin-options">
                <h3>Opciones de Administrador</h3>
                <ul>
                    <li><a href="crear_vuelo.php">Crear Vuelo</a></li>
                    <li><a href="gestionar_usuarios.php">Gestionar Usuarios</a></li>
                </ul>
            </div>
        <?php } ?>
    </div>
</body>
</html>

