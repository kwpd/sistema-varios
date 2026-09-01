<?php
// Configuración de la Conexión 1 (Servidor Principal)
$db1_host = '127.0.0.1';
$db1_name = 'nombre_base_datos';
$db1_user = 'usuario_1';
$db1_pass = 'password_1';

// Configuración de la Conexión 2 (Servidor Secundario / Respaldos)
$db2_host = '192.168.1.50';
$db2_name = 'nombre_base_datos';
$db2_user = 'usuario_2';
$db2_pass = 'password_2';

$pdo = null;

try {
    // Intentar Conexión 1
    $pdo = new PDO(
        "mysql:host=$db1_host;dbname=$db1_name;charset=utf8", 
        $db1_user, 
        $db1_pass, 
        [
            PDO::ATTR_TIMEOUT => 3, // Espera máxima de 3 segundos antes de pasar a la 2da conexión
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );
} catch (PDOException $e) {
    try {
        // Intentar Conexión 2 (Secundaria)
        $pdo = new PDO(
            "mysql:host=$db2_host;dbname=$db2_name;charset=utf8", 
            $db2_user, 
            $db2_pass, 
            [
                PDO::ATTR_TIMEOUT => 3,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );
    } catch (PDOException $e2) {
        // Si fallan ambas conexiones
        die("Error: No se pudo conectar a ninguna base de datos.");
    }
}
?>
