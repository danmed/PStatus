<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="refresh" content="20">
    <title>PStatus</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
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

  <nav class="navbar navbar-inverse navbar-static-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php"><img src="icons/pstatus_logo_small.png"></a>
		</div>
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#">About</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Refresh<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="index.php?refresh=5">5 seconds</a></li>
						<li><a href="index.php?refresh=10">10 seconds</a></li>
						<li><a href="index.php?refresh=15">15 seconds</a></li>
						<li><a href="index.php?refresh=20">20 seconds</a></li>
						<li><a href="index.php?refresh=25">25 seconds</a></li>
						<li><a href="index.php?refresh=30">30 seconds</a></li>
						<li><a href="index.php?refresh=35">35 seconds</a></li>
						<li><a href="index.php?refresh=40">40 seconds</a></li>
						<li><a href="index.php?refresh=45">45 seconds</a></li>
						<li><a href="index.php?refresh=50">50 seconds</a></li>
						<li><a href="index.php?refresh=55">55 seconds</a></li>
						<li><a href="index.php?refresh=60">60 seconds</a></li>
					</ul>
				</li>
				<li><a href="serveradd.php">Admin</a></li>
			</ul>
		</div>
	</div>
</nav>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script type="text/javascript">

$(document).ready(function(){
    $("#status td.on_off:contains('false')").css('background-color','#E05667');
	$("#status td.on_off:contains('true')").css('background-color','#56E08E');
});

</script>
<center>
<div class="container">

<?PHP
$parent = $_GET['parent'];
$device = $_GET['device'];
$ip = $_GET['ip'];
?>

<table class="table" id="status" cellpadding="4" cellspacing="4" border="1">
<thead>
<tr><th colspan="4"><center><b><img src="icons/001-window.png">&nbsp;Service Ping Status for <?PHP echo $device; ?></th></tr>
</thead>
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

