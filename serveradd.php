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
    $("#status td.on_off:contains('offline')").css('background-color','#E05667');
	$("#status td.on_off:contains('online')").css('background-color','#56E08E');
});

</script>
<center>
<div class="container">
<?PHP
include "config.inc.php";
$db_handle = mysqli_connect($DBServer, $DBUser, $DBPassword);
$db_found = mysqli_select_db($db_handle, 'status');
  
  if (isset($_POST['addserver']))
  {
    $device = $_POST['device'];
    $ip = $_POST['ip'];
    $info = $_POST['info'];
    $purpose = $_POST['purpose'];
    $sql = "INSERT INTO servers (device, ip, info, purpose) VALUES ('$device', '$ip', '$info', '$purpose')";
    if (mysqli_query($db_handle, $sql)) {
    $updateresult = "New record created successfully";
} else {
    $updateresult = "Error: " . $sql . "<br>" . mysqli_error($db_handle);
}
  }
 
   if (isset($_POST['addservice']))
  {
    $name = $_POST['name'];
    $port = $_POST['port'];
    $parent = $_POST['parent'];
    $sql = "INSERT INTO services (name, port, parent) VALUES ('$name', '$port', '$parent')";
    if (mysqli_query($db_handle, $sql)) {
    $updateresult2 = "New record created successfully";
} else {
    $updateresult2 = "Error: " . $sql . "<br>" . mysqli_error($db_handle);
}
   }  
   
 if (isset($_POST['addsmart']))
  {
    $device = $_POST['device'];
    $ip = $_POST['ip'];
    $info = $_POST['info'];
    $purpose = $_POST['purpose'];
    $sql = "INSERT INTO smartdevices (device, ip, info, purpose) VALUES ('$device', '$ip', '$info', '$purpose')";
    if (mysqli_query($db_handle, $sql)) {
    $updateresult3 = "New record created successfully";
} else {
    $updateresult3 = "Error: " . $sql . "<br>" . mysqli_error($db_handle);
}
  }
?>

 <!-- ADD SERVER FORM -->
<form method="POST" action="serveradd.php">
<input type="hidden" value="addserver" name="addserver">
<table class="table" cellpadding="4" cellspacing="4" border="1">
<thead>
<tr><th colspan="4"><center><img src="icons/005-computer-screen.png">&nbsp;Add Server</th></tr>
</thead>
<tr><td>Name</td><td>IP Address</td><td>Info</td><td>Purpose</td></tr>
<tr><td><input type="text" size="20" name="device"></td><td><input type="text" size="20" name="ip"></td><td><input type="text" size="20" name="info"></td><td><input type="text" size="20" name="purpose"></td></tr>
<tr><td colspan="4"><center><input type="submit" value="submit"></td></tr>
<tr><td colspan="4"><center><?PHP echo $updateresult; ?></td></tr>
</table>
  </form>
<br>
<!-- ADD SERVICE FORM -->
<form method="POST" action="serveradd.php">
<input type="hidden" value="addservice" name="addservice">
<table class="table" cellpadding="3" cellspacing="4" border="1">
<thead>
<tr><th colspan="4"><center><img src="icons/001-window.png">&nbsp;Add Service</th></tr>
</thead>
  <tr><td>Name</td><td>Port</td><td>Parent</td></tr>
<tr><td><input type="text" size="20" name="name"></td><td><input type="text" size="20" name="port"></td><td>
<select name="parent">

<?PHP
$SQL = "select * from servers";
$result = mysqli_query($db_handle, $SQL);
while ($db_field = mysqli_fetch_assoc($result))
{
  $parentid = $db_field['id'];
  $parentname = $db_field['device'];
 
  echo "<option value='" . $parentid . "'>" . $parentname . "</option>";
}
?>
  
</td></tr>
<tr><td colspan="4"><center><input type="submit" value="submit"></td></tr>
<tr><td colspan="4"><center><?PHP echo $updateresult2; ?></td></tr>
</table>
</form>
  <br>
  <!-- ADD SMART DEVICE FORM -->
<form method="POST" action="serveradd.php">
<input type="hidden" value="addsmart" name="addsmart">
<table class="table" cellpadding="4" cellspacing="4" border="1">
<thead>
<tr><th colspan="4"><center><img src="icons/003-networking.png">&nbsp;Add Smart Device</th></tr>
</thead>
<tr><td>Name</td><td>IP Address</td><td>Info</td><td>Purpose</td></tr>
<tr><td><input type="text" size="20" name="device"></td><td><input type="text" size="20" name="ip"></td><td><input type="text" size="20" name="info"></td><td><input type="text" size="20" name="purpose"></td></tr>
<tr><td colspan="4"><center><input type="submit" value="submit"></td></tr>
<tr><td colspan="4"><center><?PHP echo $updateresult3; ?></td></tr>
</table>
  </form>
  <br>
  <?PHP include "footer.php"; ?>
</body>
</html>


