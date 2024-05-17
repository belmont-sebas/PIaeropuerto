<!DOCTYPE html>
<html>
<head>
    <title>Gestión de Aerolíneas</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div>
        <h2>Crear Aerolínea</h2>
        <form method="post" action="aerolineas.php">
            <label for="nombre">Nombre de la Aerolínea:</label>
            <input type="text" id="nombre" name="nombre" required><br>
            <label for="sede">Sede:</label>
            <input type="text" id="sede" name="sede" required><br>
            <input type="submit" value="Crear Aerolínea">
        </form>
    </div>
</body>
</html>
