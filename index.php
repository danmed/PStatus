<html>
<?PHP
$refresh = $_GET['refresh'];
if (isset($_GET['refresh'])) 
{
$refresh = $_GET['refresh'];
}
else 
{
	$refresh = "20";
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
<Center>
<table cellpadding="4" cellspacing="4" border="1">
	<tr>
		<td><a href="serveradd.php">Admin</a></td><td><form method="GET" name="refr" action="<?php echo $_SERVER['PHP_SELF'];?>"><select name="refresh" value="refresh" onchange="this.form.submit()"><option>refresh</option><option value="5">5</option><option value="10">10</option><option value="15">15</option><option value="20">20</option><option value="25">25</option><option value="30">30</option></td></tr></table></form><br>
	
<table id="status" cellpadding="4" cellspacing="4" border="1">
<tr><td colspan="4"><center><b>Server Ping Status</td></tr>
<tr><td><b>DEVICE</td><td><b>INFO</td><td><b>PURPOSE</td><td><b>STATUS</td></tr>
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
	$online  = pingtest($ip);

	print "<tr><td><a href='services.php?device=" . $device . "&parent=" . $id . "&ip=" . $ip . "' alt='" . $ip . "'>" . $device . "</a></td><td>" . $info . "</td><td>" . $purpose . "</td><td class='on_off'>" . ($online ? 'online':'offline') . "</td></tr>";
}

?>
<tr><td colspan="4"><center><b>Smart Device Ping Status</td></tr>
<tr><td><b>DEVICE</td><td><b>INFO</td><td><b>PURPOSE</td><td><b>STATUS</td></tr>
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
	$online  = pingtest($ip);

	print "<tr><td><a href='smartcontrols.php?device=" . $device . "&parent=" . $id . "'>" . $device . "</a></td><td>" . $info . "</td><td>" . $purpose . "</td><td class='on_off'>" . ($online ? 'online':'offline') . "</td></tr>";
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
	</body>
	</html>
