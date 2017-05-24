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

    <?PHP include "navbar.php"; ?>


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

<Center>

<table class="table" id="status" cellpadding="4" cellspacing="4" border="1">
<thead>
<tr><th colspan="2"><center><b>Smart Controls for <?PHP echo $device; ?></th></tr>
</thead>
<tr><td><b>POWER ON</td><td><b>POWEROFF</td></tr>
<?PHP
$db_handle = mysqli_connect('192.168.2.75', 'kodi', 'kodi');
$db_found = mysqli_select_db($db_handle, 'status');
if ($db_found) 
{
$SQL = "select * from smartcontrols where parent = '" . $parent . "'"	;
$result = mysqli_query($db_handle, $SQL);
while ($db_field = mysqli_fetch_assoc($result))
{
	$poweron = $db_field['poweron'];
	$poweroff = $db_field['poweroff'];
	
	print "<tr><td><a href='" . $poweron . "'>ON</a></td><td><a href='" . $poweroff . "'>OFF</a></td></tr>";
}
mysqli_close($db_handle);
	
}

?>
	</table>
	<?PHP include "aboutmodal.php"; ?>
	<?PHP include "footer.php"; ?>
	</body>
	</html>
