<?php
require_once 'Database.php';

// Capturar la selección manual de la conexión
$conexionSeleccionada = $_REQUEST['conexion'] ?? 'conexion1';

try {
    // Obtener la conexión seleccionada
    $db = Database::getConnection($conexionSeleccionada);
    $mensaje = "Conectado exitosamente a <b>" . htmlspecialchars($conexionSeleccionada) . "</b>";
} catch (Exception $e) {
    $mensaje = "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Prueba de Conexión MySQL con Puertos</title>
</head>
<body>

    <h2>Seleccionar Conexión Manualmente (con Puerto)</h2>

    <!-- Formulario para cambiar manualmente -->
    <form method="GET" action="Test.php">
        <label for="conexion">Elige la conexión:</label>
        <select name="conexion" id="conexion" onchange="this.form.submit()">
            <option value="conexion1" <?= $conexionSeleccionada === 'conexion1' ? 'selected' : '' ?>>
                Conexión 1 (Puerto 3306)
            </option>
            <option value="conexion2" <?= $conexionSeleccionada === 'conexion2' ? 'selected' : '' ?>>
                Conexión 2 (Puerto 3307)
            </option>
        </select>
        <button type="submit">Cambiar Conexión</button>
    </form>

    <hr>

    <h3>Estado de la conexión:</h3>
    <p><?= $mensaje ?></p>

    <?php if (isset($db)): ?>
        <?php
            $stmt = $db->query("SELECT NOW() as fecha_hora, DATABASE() as bd, @@port as puerto_actual");
            $res = $stmt->fetch();
        ?>
        <ul>
            <li><b>Base de datos:</b> <?= $res['bd'] ?></li>
            <li><b>Puerto conectado en el servidor:</b> <?= $res['puerto_actual'] ?></li>
            <li><b>Fecha/Hora del servidor:</b> <?= $res['fecha_hora'] ?></li>
        </ul>
    <?php endif; ?>

</body>
</html>
