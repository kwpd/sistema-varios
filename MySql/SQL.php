<?php
// Se hizo una prueba con la version XAMPP v3.3.0
require_once __DIR__ . '/config.php';

$dsn = "mysql:host={$host};port=3306;dbname={$dbname};charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}

$sql = "SELECT ROW_NUMBER() OVER (ORDER BY skillpoints DESC) AS row_num, nick, skillpoints, pug_k, pug_a, pug_hsp, pug_bp,
	pug_bd, pug_rws, pug_win, pug_los FROM basicpointsstats LIMIT 15";
$stmt = $pdo->query($sql);
$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>