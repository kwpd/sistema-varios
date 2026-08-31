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
<style type="text/css">
table.ranking { width:100%; border-collapse:collapse; font-size:13px; }
table.ranking thead th {
	background-color:#1c212b;
	color:#ff9900;
	text-transform:uppercase;
	font-size:10px;
	letter-spacing:.5px;
	padding:9px 6px;
	border-bottom:2px solid #ff9900;
	text-align:center;
}
table.ranking thead th img { width:20px; height:20px; vertical-align:middle; }
table.ranking td {
	padding:7px 6px;
	border-bottom:1px solid #232830;
	text-align:center;
	color:#bbb;
}
table.ranking tbody tr:nth-child(even) { background-color:#171b22; }
table.ranking td.name { text-align:left; color:#eee; font-weight:bold; }
table.ranking td.score { color:#06dcf8; font-weight:bold; }
table.ranking td.kills { color:#fff; }
table.ranking .badge {
	display:inline-block;
	width:20px;
	height:20px;
	line-height:20px;
	border-radius:50%;
	font-weight:bold;
	font-size:11px;
	color:#111;
}
table.ranking .badge-1 { background-color:#ffd700; }
table.ranking .badge-2 { background-color:#c0c0c0; }
table.ranking .badge-3 { background-color:#cd7f32; }
</style>
<table class="ranking">
  <thead>
    <tr>
      <th>#</th>
      <th style="text-align:left;">Nombre</th>
      <th>Puntuaci&oacute;n</th>
      <th>Matanza</th>
      <th>Asistencia</th>
      <th><img src="imagenpanagamers/balaenlacabeza.jpg" alt="HS" /></th>
      <th><img src="imagenpanagamers/C4.jpg" alt="C4" /></th>
      <th><img src="imagenpanagamers/Defuse.jpg" alt="Defuse" /></th>
      <th>Rondas Ganadas</th>
      <th>M. Win</th>
      <th>M. Loss</th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($resultados as $BASIC_POINTS_STATS):
    $row = (int) $BASIC_POINTS_STATS['row_num'];
    $rankCell = $row <= 3
        ? "<span class=\"badge badge-{$row}\">{$row}</span>"
        : $row;
?>
    <tr>
      <td><?php echo $rankCell; ?></td>
      <td class="name"><?php echo htmlspecialchars($BASIC_POINTS_STATS['nick']); ?></td>
      <td class="score"><?php echo htmlspecialchars($BASIC_POINTS_STATS['skillpoints']); ?></td>
      <td class="kills"><?php echo htmlspecialchars($BASIC_POINTS_STATS['pug_k']); ?></td>
      <td><?php echo htmlspecialchars($BASIC_POINTS_STATS['pug_a']); ?></td>
      <td><?php echo htmlspecialchars($BASIC_POINTS_STATS['pug_hsp']); ?></td>
      <td><?php echo htmlspecialchars($BASIC_POINTS_STATS['pug_bp']); ?></td>
      <td><?php echo htmlspecialchars($BASIC_POINTS_STATS['pug_bd']); ?></td>
      <td><?php echo htmlspecialchars($BASIC_POINTS_STATS['pug_rws']); ?></td>
      <td><?php echo htmlspecialchars($BASIC_POINTS_STATS['pug_win']); ?></td>
      <td><?php echo htmlspecialchars($BASIC_POINTS_STATS['pug_los']); ?></td>
    </tr>
<?php endforeach; ?>
  </tbody>
</table>
