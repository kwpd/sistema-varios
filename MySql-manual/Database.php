<?php

class Database {
    // Credenciales únicas para ambas conexiones
    private static $user    = 'tu_usuario';
    private static $pass    = 'tu_contrasena';
    private static $db      = 'tu_base_de_datos';
    private static $charset = 'utf8mb4';

    // Hosts / IPs de los dos servidores
    private static $hosts = [
        'conexion1' => '192.168.1.100', // IP o Host del Servidor 1
        'conexion2' => '192.168.1.200'  // IP o Host del Servidor 2
    ];

    public static function getConnection($conexion = 'conexion1') {
        if (!array_key_exists($conexion, self::$hosts)) {
            throw new Exception("La conexión '$conexion' no existe.");
        }

        $host = self::$hosts[$conexion];
        $dsn = "mysql:host={$host};dbname=" . self::$db . ";charset=" . self::$charset;

        try {
            return new PDO($dsn, self::$user, self::$pass, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]);
        } catch (PDOException $e) {
            die("Error al conectar con {$conexion} ({$host}): " . $e->getMessage());
        }
    }
}