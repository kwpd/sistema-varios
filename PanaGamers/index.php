<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Panagamers CS 1.6</title>
<style type="text/css">
* { margin:0; padding:0; box-sizing:border-box; }
body {
	background-color:#000;
	font-family:"Segoe UI", Arial, Helvetica, sans-serif;
	color:#ccc;
	padding:16px 0;
}
.panel {
	max-width:1000px;
	min-width:760px;
	margin:0 auto;
	background:#12151b;
	border:1px solid #2a2f3a;
	border-radius:10px;
	overflow:hidden;
}
.panel-header {
	background-color:#1a1f29;
	padding:16px 22px;
	border-bottom:1px solid #2a2f3a;
}
.panel-header table { width:100%; border-collapse:collapse; }
.panel-header td { vertical-align:middle; }
.panel-header .title {
	color:#ff9900;
	font-size:20px;
	font-weight:bold;
	letter-spacing:.5px;
}
.panel-header .subtitle {
	color:#999;
	font-size:12px;
	margin-top:4px;
}
.discord-btn {
	display:inline-block;
	margin-top:6px;
	padding:5px 12px;
	background-color:#5865F2;
	color:#fff;
	border-radius:14px;
	font-size:11px;
	text-decoration:none;
	font-weight:bold;
}
.panel-header .logo { text-align:right; }
.panel-header .logo img { max-width:180px; height:auto; }

.nav-bar {
	background-color:#0d1015;
	padding:10px 16px;
	border-bottom:2px solid #ff9900;
}
.nav-bar table { border-collapse:collapse; }
.nav-tab {
	display:inline-block;
	padding:8px 18px;
	margin-right:6px;
	font-size:12px;
	font-weight:bold;
	letter-spacing:.5px;
	text-transform:uppercase;
	color:#999;
	text-decoration:none;
	border-radius:5px;
	border:1px solid transparent;
}
.nav-tab.active {
	color:#ff9900;
	border-color:#ff9900;
	background-color:rgba(255,153,0,.08);
}

.panel-body { padding:18px 22px; }
.placeholder {
	text-align:center;
	padding:40px 20px;
	color:#666;
	font-size:13px;
}
.panel-footer {
	padding:10px 22px;
	text-align:center;
	font-size:11px;
	color:#666;
	border-top:1px solid #232830;
	background-color:#0d1015;
}
</style>
</head>

<body>
<div class="panel">
  <div class="panel-header">
    <table>
      <tr>
        <td>
          <div class="title">Panagamers CS 1.6</div>
          <div class="subtitle">Panama Counter-Strike 1.6 Community</div>
          <a class="discord-btn" href="https://discord.gg/yB4RJKMyQP">Discord: discord.gg/yB4RJKMyQP</a>
        </td>
        <td class="logo"><img src="https://i.imgur.com/wIuqdA1.png" alt="PanaGamers" /></td>
      </tr>
    </table>
  </div>
<?php
$nav_items = [
    '' => 'Ranking',
    'weapom' => 'Armas',
    'versus' => 'Versus',
    'gungame' => 'GunGame',
];
$go = isset($_GET['go']) ? $_GET['go'] : '';
?>
  <div class="nav-bar">
<?php foreach ($nav_items as $key => $label):
    $href = $key === '' ? 'index.php' : 'index.php?go=' . urlencode($key);
    $active = ($go === $key) ? ' active' : '';
?>
    <a class="nav-tab<?php echo $active; ?>" href="<?php echo $href; ?>"><?php echo htmlspecialchars($label); ?></a>
<?php endforeach; ?>
  </div>
  <div class="panel-body">
<?php
$allowed_pages = ['home', 'top', 'weapom', 'versus', 'gungame',
'AK47', 'AUG', 'AWP', 'C4', 'DEAGLE', 'ELITE', 'FAMAS', 'FIVESEVEN',
'G3SG1', 'GALIL', 'GLOCK18', 'HEGRENADE', 'KNIFE', 'M3', 'M4A1', 'M249',
'MAC10', 'MP5NAVY', 'P90', 'P228', 'SCOUT', 'SG550', 'SG552', 'TMP', 'UMP45', 'USP', 'XM1014'];

if ($go === '') {
    include('MOTD_top.php');
} elseif (in_array($go, $allowed_pages) && file_exists(__DIR__ . '/' . $go . '.php')) {
    include($go . '.php');
} elseif (in_array($go, $allowed_pages)) {
    echo '<div class="placeholder">Esta seccion esta en construccion. Vuelve pronto.</div>';
} else {
    include('MOTD_top.php');
}
?>
  </div>
  <div class="panel-footer">Copyright &copy; BASIC POINTS STATS</div>
</div>
</body>
</html>
