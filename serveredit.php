<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PStatus</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

  <body>

  <?PHP include "navbar.php"; ?>


    <script src="https://code.jquery.com/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

<center>
<div class="container">
<table class="table table-striped" id="status" cellpadding="4" cellspacing="4" border="1">
	<thead>
		<tr><th colspan="7"><center><img src="icons/005-computer-screen.png">&nbsp;Edit Servers</th></tr>
		<tr><th><b>DEVICE</th><th><b>IP</th><th><b>INFO</th><th><b>PURPOSE</th><th><b>UPDATE</th><th>RESET</th><th>DELETE</th></tr>
</thead>
		<tbody>
<?PHP
include "config.inc.php"; 
if (isset($_POST['reset'])) 
{
$resetid = $_POST['reset'];
$show_modal = true;
$db_handle = mysqli_connect($DBServer, $DBUser, $DBPassword);
$db_found = mysqli_select_db($db_handle, 'status');
$SQLRESET = "UPDATE servers SET count = '0', ups = '0', downs='0', lastreset = '" . $date . "' WHERE id = '" . $resetid . "'";
if (mysqli_query($db_handle, $SQLRESET)) {
    $OUTPUT = "Uptime Count reset to 0";
	} else {
    $OUTPUT = "Error resetting Uptime Count: " . mysqli_error($db_handle);
}
}

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

<form method="POST" action="serveredit.php">
<input type="hidden" value="updateserver" name="<?PHP echo $id; ?>">
<tr><td><input type="text" size="20" name="device" value="<?PHP echo $device; ?>"</td><td><input type="text" size="20" name="ip" value="<?PHP echo $ip;?>"</td><td><input type="text" size="20" name="info" value="<?PHP echo $info; ?>"</td><td><input type="text" size="20" name="purpose" value="<?PHP echo $purpose; ?>"</td><td><input type="submit" value="update" class="btn btn-success"></form></td><td><form method="POST" action="serveredit.php"><input type="hidden" name="reset" value="<?PHP echo $id; ?>"><input type="submit" value="Reset" class="btn btn-warning"></td><td><form method="POST" action="serveredit.php"><input type="hidden" name="delete" value="<?PHP echo $id; ?>"><input type="submit" value="delete" class="btn btn-danger"></form></td></tr>

<?PHP
 }
 }
 ?>
	
<?php if($show_modal):?>
<script type='text/javascript'>$("#myModal").modal("show")</script>
	Done!!!
<?php endif;?>
	
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">PStatus - Action Result</h4>
      </div>
      <div class="modal-body">
        <p><?PHP echo $RESETRESULT; ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
	</body>
	</html>
