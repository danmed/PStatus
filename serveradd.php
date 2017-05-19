<html>
<head>
<title>
PStatus - Add Server
</title>
<style>
body
{
font-family:courier,serif
}
</style>
<?PHP
include "config.inc.php";
$db_handle = mysqli_connect($DBServer, $DBUser, $DBPassword);
$db_found = mysqli_select_db($db_handle, 'status');
  if (isset $_GET['doit'])
  {
    $device = $db_field['device'];
    $ip = $db_field['ip'];
    $info = $db_field['info'];
    $purpose = $db_field['purpose'];
    $sql = "INSERT INTO servers (device, ip, info, purpose)VALUES ($device, $ip, $info, $purpose)";
    mysqli_query($db_handle, $sql);
  }

</head>
<body>
<center>
  <form method="serveradd.php" action="get">
<table cellpadding="4" cellspacing="4" border="1">
<tr><td colspan="4"><center>Add Server</td></tr>
<tr><td>Name</td><td>IP Address</td><td>Info</td><td>Purpose</td></tr>
<tr><td><input type="text" size="20" name="device"></td><td><input type="text" size="20" name="ip"></td><td><input type="text" size="20" name="info"></td><td><input type="text" size="20" name="purpose"></td></tr>
</table>
<br>
<input type="hidden" value="doit" name="doit">
<input type="submit" value="submit">
</form>
