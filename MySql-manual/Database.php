<?php

class Database {
    // Credenciales compartidas
    private static $user    = 'tu_usuario';
    private static $pass    = 'tu_contrasena';
    private static $db      = 'tu_base_de_datos';
    private static $charset = 'utf8mb4';

    // Configuración de Host y Puerto para cada conexión
    private static $servers = [
        'conexion1' => [
            'host' => '192.168.1.100',
            'port' => 3306 // Puerto por defecto de MySQL
        ],
        'conexion2' => [
            'host' => '192.168.1.200',
            'port' => 3307 // Puerto alternativo o personalizado
        ]
    ];

    public static function getConnection($conexion = 'conexion1') {
        if (!array_key_exists($conexion, self::$servers)) {
            throw new Exception("La conexión '$conexion' no está configurada.");
        }

        $srv  = self::$servers[$conexion];
        $host = $srv['host'];
        $port = $srv['port'];

        // Se incluye ;port= en el DSN de conexión
        $dsn = "mysql:host={$host};port={$port};dbname=" . self::$db . ";charset=" . self::$charset;

        try {
            return new PDO($dsn, self::$user, self::$pass, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]);
        } catch (PDOException $e) {
            die("Error al conectar a {$conexion} ({$host}:{$port}): " . $e->getMessage());
        }
    }
}
?>
