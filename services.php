<html>
<head>
<meta http-equiv="refresh" content="20">
<?PHP
$parent = $_GET['parent'];
$device = $_GET['device'];
$ip = $_GET['ip'];
?>
<title>
Status
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
    $("#status td.on_off:contains('false')").css('background-color','#ff0000');
	$("#status td.on_off:contains('true')").css('background-color','#00ff00');
});

</script>
</head>
<body>
<Center>

<table id="status" cellpadding="4" cellspacing="4" border="1">
<tr><td colspan="4"><center><b><img src="icons/003-window.png">&nbsp;Service Ping Status for <?PHP echo $device; ?></td></tr>
<tr><td><b>DEVICE</td><td><b>PORT</td><td><b>STATUS</td></tr>
<?PHP

$db_handle = mysqli_connect('192.168.2.75', 'kodi', 'kodi');
$db_found = mysqli_select_db($db_handle, 'status');

if ($db_found) 
{
$SQL = "select * from services where parent = '" . $parent . "'"	;
$result = mysqli_query($db_handle, $SQL);
while ($db_field = mysqli_fetch_assoc($result))
{
	$name = $db_field['name'];
	$port = $db_field['port'];
	$online  = servicetest($ip, $port);

	print "<tr><td>" . $name . "</td><td>" . $port . "</td><td class='on_off'>" . ($online ? 'true':'false') . "</td></tr>";
}

mysqli_close($db_handle);
	
}

function servicetest($ip, $port) {
    $socket = @fsockopen($ip, $port, $errorNo, $errorStr, 3);
    if ($errorNo == 0) {
        return true;
    } else {
        return false;
    }
}

mysqli_close($db_handle);

?>

