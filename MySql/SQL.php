Google Gemini, kwpd
<?php
// SQL.php
require_once 'config.php';

try {
    // Ejemplo de uso de la conexión PDO establecida en config.php
    $stmt = $pdo->prepare("SELECT * FROM tu_tabla");
    $stmt->execute();
    $resultados = $stmt->fetchAll();
    
} catch (Exception $e) {
    echo "Error en la consulta: " . $e->getMessage();
}
$sql = "SELECT ROW_NUMBER() OVER (ORDER BY skillpoints DESC) AS row_num, nick, skillpoints, pug_k, pug_a, pug_hsp, pug_bp,
	pug_bd, pug_rws, pug_win, pug_los FROM basicpointsstats LIMIT 15";
$stmt = $pdo->query($sql);
$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
