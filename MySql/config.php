Google Gemini, kwpd
<?php
/**
 * Archivo de Configuración y Conexión optimizado con soporte de doble IP (Failover)
 */

// Definición de IPs por prioridad: [0] Servidor Principal, [1] Servidor de Respaldo
$ips = ['192.168.1.100', '192.168.1.101'];[cite: 1]

$dbName   = 'tu_base_de_datos'; // Reemplaza con el nombre de tu BD
$username = 'usuario';         // Reemplaza con tu usuario
$password = 'contraseña';      // Reemplaza con tu contraseña
$pdo      = null;

foreach ($ips as $index => $ip) {
    try {
        $dsn = "mysql:host=$ip;dbname=$dbName;charset=utf8mb4";
        
        $options = [
            PDO::ATTR_TIMEOUT => 2,                     // 2 segundos de espera para no congelar la app si la IP no responde[cite: 1]
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,  // Lanzar excepciones en caso de error SQL
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        $pdo = new PDO($dsn, $username, $password, $options);
        
        // Si la conexión es exitosa, detenemos el ciclo y usamos esta IP
        break;[cite: 1]
        
    } catch (PDOException $e) {
        // Si ocurre un error, muestra un registro opcional en entorno de desarrollo y continúa con la siguiente IP
        // error_log("Fallo al conectar con la IP {$ip}: " . $e->getMessage());
        continue;[cite: 1]
    }
}

// Verificación crítica final si ninguna de las dos IPs respondió
if (!$pdo) {
    // Detiene la ejecución de forma limpia si no hay base de datos disponible
    http_response_code(500);
    die("Error crítico: No se pudo establecer conexión con ningún servidor de base de datos disponible.");[cite: 1]
}
