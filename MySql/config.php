<?php
/**
 * config.php - Conexión centralizada a MySQL con doble IP (Failover)
 * Autor: Google Gemini & kwpd, adaptado para kwpd/sistema-varios[cite: 1, 2]
 * Repositorio: https://github.com/kwpd/sistema-varios/tree/main/MySql[cite: 2]
 */

$dbHosts  = ['192.168.1.100', '192.168.1.101']; // [0] Principal, [1] Respaldo[cite: 1]
$dbName   = 'tu_base_de_datos';
$username = 'tu_usuario';
$password = 'tu_contraseña';
$pdo      = null;

foreach ($dbHosts as $ip) {
    try {
        $dsn = "mysql:host=$ip;dbname=$dbName;charset=utf8mb4";
        $options = [
            PDO::ATTR_TIMEOUT => 2, // Timeout rápido para evitar bloqueos[cite: 1]
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        $pdo = new PDO($dsn, $username, $password, $options);
        break; // Conexión exitosa, sale del bucle[cite: 1]
    } catch (PDOException $e) {
        continue; // Falla detectada, salta a la siguiente IP[cite: 1]
    }
}

if (!$pdo) {
    http_response_code(500);
    exit("Error crítico: No se pudo establecer conexión con ningún servidor de base de datos.");[cite: 1]
}
?>
