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
    $info = $_POST['info'];
    $sql = "INSERT INTO services (name, port, parent, info) VALUES ('$name', '$port', '$parent', '$info')";
    if (mysqli_query($db_handle, $sql)) {
    $updateresult2 = "New record created successfully";
} else {
    $updateresult2 = "Error: " . $sql . "<br>" . mysqli_error($db_handle);
}
   }  
   

?>
</head>
<body>
<center>
<!-- ADD SERVER FORM -->
<form method="POST" action="serveradd.php">
<input type="hidden" value="addserver" name="addserver">
<table cellpadding="4" cellspacing="4" border="1">
<tr><td colspan="4"><center>Add Server</td></tr>
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
<table cellpadding="3" cellspacing="4" border="1">
<tr><td colspan="4"><center>Add Service</td></tr>
  <tr><td>Name</td><td>Port</td><td>Parent</td><td>Info</td></tr>
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
  
</td><td><input type="text" size="20" name="info"></tr>
<tr><td colspan="4"><center><input type="submit" value="submit"></td></tr>
<tr><td colspan="4"><center><?PHP echo $updateresult2; ?></td></tr>
</table>
</form>
</body>
</html>


