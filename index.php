<html>
<?PHP
include "config.inc.php";

if (isset($_GET['refresh'])) 
{
$refresh = $_GET['refresh'];
}
?>
	
<head>
<meta http-equiv="refresh" content="<?PHP echo $refresh; ?>">
<title>
PStatus
</title>
<style>
body
{
font-family:courier,serif
}
.percentbar { background:#ff0000; border:1px solid #000000; height:10px; }
.percentbar div { background: #00ff00; height: 10px; }
</style>
	
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.js"></script>
<script type="text/javascript">

$(document).ready(function(){
    $("#status td.on_off:contains('offline')").css('background-color','#ff0000');
	$("#status td.on_off:contains('online')").css('background-color','#00ff00');
});

</script>
</head>
<body>
<div id="main">
<Center><form method="GET" name="refr" action="<?php echo $_SERVER['PHP_SELF'];?>">
<table cellpadding="4" cellspacing="4" border="1">
	<tr>
		<td><img src="icons/001-wrench-tool.png">&nbsp;<a href="" onclick="openNav()">Admin</a></td><td><img src="icons/pstatus_logo_small.png"></td><td><img src="icons/002-arrows.png">&nbsp;<select name="refresh" value="refresh" onchange="this.form.submit()"><option>refresh</option><option value="5">5</option><option value="10">10</option><option value="15">15</option><option value="20">20</option><option value="25">25</option><option value="30">30</option></td></tr></table></form><br>
	
<table id="status" cellpadding="4" cellspacing="4" border="1">
<tr><td colspan="5"><center><b><img src="icons/005-computer-screen.png" width="16" height="16">&nbsp;Server Ping Status</td></tr>
	<tr><td><b>DEVICE</td><td><b>INFO</td><td><b>PURPOSE</td><td><b>STATUS</td><td><b>UPTIME</td></tr>
<?PHP
include "config.inc.php";
$db_handle = mysqli_connect($DBServer, $DBUser, $DBPassword);
$db_found = mysqli_select_db($db_handle, 'status');

if ($db_found) 
{
$SQL = "select * from servers"	;
$result = mysqli_query($db_handle, $SQL);
while ($db_field = mysqli_fetch_assoc($result))
{
	$device = $db_field['device'];
	$ip = $db_field['ip'];
	$id = $db_field['id'];
	$port = $db_field['port'];
	$info = $db_field['info'];
	$purpose = $db_field['purpose'];
	$count = $db_field['count'];
	$ups = $db_field['ups'];
	$downs = $db_field['downs'];
	$online  = pingtest($ip);
	$value = $ups;
	$max = $count;
	$scale = 1.0;
	if ( !empty($max) ) { $percent = ($value * 100) / $max; } 
	else { $percent = 0; }
	if ( $percent > 100 ) { $percent = 100; }
	print "<tr><td><a href='services.php?device=" . $device . "&parent=" . $id . "&ip=" . $ip . "' alt='" . $ip . "'>" . $device . "</a></td><td>" . $info . "</td><td>" . $purpose . "</td><td class='on_off'>" . ($online ? 'online':'offline') . "</td><td><div class='percentbar' style='width:". round(100 * $scale) ."px;'><div style='width:" . round($percent * $scale) ."px;'><Center><font size='1'>" . round($percent * $scale) . "%</div></div></td></tr>";
}

?>
<tr><td colspan="5"><center><b><img src="icons/003-networking.png">&nbsp;Smart Device Ping Status</td></tr>
	<tr><td><b>DEVICE</td><td><b>INFO</td><td><b>PURPOSE</td><td><b>STATUS</td><td><b>UPTIME</td></tr>
<?PHP

$SQL = "select * from smartdevices"	;
$result = mysqli_query($db_handle, $SQL);
while ($db_field = mysqli_fetch_assoc($result))
{
	$device = $db_field['device'];
	$ip = $db_field['ip'];
	$id = $db_field['id'];
	$port = $db_field['port'];
	$info = $db_field['info'];
	$purpose = $db_field['purpose'];
	$count = $db_field['count'];
	$ups = $db_field['ups'];
	$downs = $db_field['downs'];
	$online  = pingtest($ip);
	$value = $ups;
	$max = $count;
	$scale = 1.0;
	if ( !empty($max) ) { $percent = ($value * 100) / $max; } 
	else { $percent = 0; }
	if ( $percent > 100 ) { $percent = 100; }

	print "<tr><td><a href='smartcontrols.php?device=" . $device . "&parent=" . $id . "'>" . $device . "</a></td><td>" . $info . "</td><td>" . $purpose . "</td><td class='on_off'>" . ($online ? 'online':'offline') . "</td><td><div class='percentbar' style='width:". round(100 * $scale) ."px;'><div style='width:" . round($percent * $scale) ."px;'><Center><font size='1'>" . round($percent * $scale) . "%</div></div></td></tr>";
}

mysqli_close($db_handle);
	
}

function pingtest($ip) {
    
	exec(sprintf('ping -c 1 -W 5 %s', escapeshellarg($ip)), $errorNo, $errorStr);
	return $errorStr === 0;

}

mysqli_close($db_handle);

?>
	<script>
		var myVar;

function myFunction() {
    myVar = setTimeout(showPage, 3000);
}

function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("myDiv").style.display = "block";
}
	</script>
	
	</table>
	<br>
	<?PHP include "footer.php"; ?>
	</div>
	
<div id="mySidenav" class="sidenav">
<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
<a href="#">About</a>
<a href="#">Services</a>
<a href="#">Clients</a>
<a href="#">Contact</a>
</div>
	</body>
	</html>
