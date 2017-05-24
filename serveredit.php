<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="refresh" content="<?PHP echo $refresh; ?>">
    <title>PStatus</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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

<center>
<div class="container">
<table class="table table-striped" id="status" cellpadding="4" cellspacing="4" border="1">
	<thead>
		<tr><th><b>DEVICE</th><th><b>IP</th><th><b>INFO</th><th><b>PURPOSE</th><th><b>UPDATE</th><th>RESET</th></tr>
		<tr><th colspan="4"><center><img src="icons/005-computer-screen.png">&nbsp;Edit Servers</th></tr>
</thead>
		<tbody>
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
 ?>
<form method="POST" action="serveradd.php">
<input type="hidden" value="updateserver" name="<?PHP echo $id; ?>">
<tr><td><input type="text" size="20" name="device" value="<?PHP echo $device; ?>"</td><td><input type="text" size="20" name="ip" value="<?PHP echo $ip;?>"</td><td><input type="text" size="20" name="info" value="<?PHP echo $info; ?>"</td><td><input type="text" size="20" name="purpose" value="<?PHP echo $purpose; ?>"</td><td><input type="submit" value="update></td><td>RESET</td></tr>

  </form>
<?PHP
 }
 }
 ?>
