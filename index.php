<!DOCTYPE html>
<?PHP
include "config.inc.php";
if (isset($_GET['refresh'])) 
{
$refresh = $_GET['refresh'];
}
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="refresh" content="<?PHP echo $refresh; ?>">
    <title>PStatus</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="js/jquery.dataTables.min.css"></style>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>	 
	  
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  <style>
  .progress {
    margin-bottom: 0 !important;
	background-color: #DA2A2A;
    -webkit-box-shadow: none;
    box-shadow: none;
}

</style>
	</head>

  <body>

    <?PHP include "navbar.php"; ?>


	<script type="text/javascript">

$(document).ready(function(){
    $("#status td.on_off:contains('offline')").css('background-color','#E05667');
	$("#status td.on_off:contains('online')").css('background-color','#56E08E');
	$('#status').dataTable();
});

</script>
<center>
<div class="container">
	
	<table class="table table-striped" id="status" cellpadding="4" cellspacing="4" border="1">
	<thead>
	<tr><th colspan="5"><center><b><img src="icons/005-computer-screen.png" width="16" height="16">&nbsp;Server Ping Status</th></tr>
	<tr><th><b>DEVICE</th><th><b>INFO</th><th><b>PURPOSE</th><th><b>STATUS</th><th><b>UPTIME</th></tr>
	</thead>
	<tbody>
<?PHP

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
	print "<tr><td><a href='services.php?device=" . $device . "&parent=" . $id . "&ip=" . $ip . "' alt='" . $ip . "'>" . $device . "</a></td><td>" . $info . "</td><td>" . $purpose . "</td><td class='on_off'><Center>" . ($online ? 'online':'offline') . "</td><td><div class='progress'><div class='progress-bar progress-bar-success' role='progressbar' aria-valuenow='" . round($percent * $scale) . "' aria-valuemin='0' aria-valuemax='100' style='width:" . round($percent * $scale) . "%'>" . round($percent * $scale) . "%</div></div></td></tr>";
}

if ($enable_smart == "1")
{
?>
<thead>
<tr><th colspan="5"><center><b><img src="icons/003-networking.png">&nbsp;Smart Device Ping Status</th></tr>
	<tr><th><b>DEVICE</th><th><b>INFO</th><th><b>PURPOSE</th><th><b>STATUS</th><th><b>UPTIME</th></tr>
</thead>
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

	print "<tr><td><a href='smartcontrols.php?device=" . $device . "&parent=" . $id . "'>" . $device . "</a></td><td>" . $info . "</td><td>" . $purpose . "</td><td class='on_off'><center>" . ($online ? 'online':'offline') . "</td><td><div class='progress'><div class='progress-bar progress-bar-success' role='progressbar' aria-valuenow='" . round($percent * $scale) . "' aria-valuemin='0' aria-valuemax='100' style='width:" . round($percent * $scale) . "%'>" . round($percent * $scale) . "%</div><div></td></tr>";
}

mysqli_close($db_handle);
	
}
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
	</tbody>
	</table>
	<br>
	<?PHP include "footer.php"; ?>
	<?PHP include "aboutmodal.php"; ?>
  </body>
</html>
