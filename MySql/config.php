Google Gemini, kwpd
<?php
$ips = ['192.168.1.100', '192.168.1.101']; //[cite: 1] 192.168.1.100 = Principal, 192.168.1.101 = Respaldo
$dbName = 'tu_base_de_datos';
$username = 'usuario';
$password = 'contraseña';
$pdo = null;

foreach ($ips as $ip) {
    try {
        $dsn = "mysql:host=$ip;dbname=$dbName;charset=utf8mb4";
        $pdo = new PDO($dsn, $username, $password, [
            PDO::ATTR_TIMEOUT => 3, //[cite: 1] Tiempo de espera de 3 segundos para evitar bloqueos prolongados
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
        break; //[cite: 1] Conexión exitosa, sale del ciclo
    } catch (PDOException $e) {
        continue; //[cite: 1] Falla detectada, salta a la siguiente IP
    }
}

if (!$pdo) {
    throw new Exception("Error crítico: No se pudo establecer conexión con ningún servidor de base de datos."); //[cite: 1]
}
